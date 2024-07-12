import time
import datetime;
import paho.mqtt.client as mqtt
import ssl
import json
import _thread
import board
import busio
import adafruit_ads1x15.ads1115 as ADS
from adafruit_ads1x15.analog_in import AnalogIn
import Adafruit_DHT
import RPi.GPIO as GPIO
from gpiozero import MotionSensor
from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTClient
import json
import signal


def on_connect(client, userdata, flags, rc):
    print("Connected to AWS IoT: " + str(rc))

#mqtt send data
client = mqtt.Client()
client.on_connect = on_connect
client.tls_set(ca_certs='./rootCA.pem', certfile='./certificate.pem.crt', keyfile='./private.pem.key', tls_version=ssl.PROTOCOL_SSLv23)
client.tls_insecure_set(True)
client.connect("Your Endpoint", 8883, 60)

#mqtt retrive data
awsiot_endpoint = "aws"
root_ca_path = './rootCA.pem'
private_key_path = './private.pem.key'
certificate_path = './certificate.pem.crt'
topic = "raspi/DHT11"
topic2 = "raspi/c"

# Initialize AWSIoTMQTTClient
myMQTTClient = AWSIoTMQTTClient("myClientID")
myMQTTClient.configureEndpoint(awsiot_endpoint, 8883)  # Use port 8883 for MQTT over TLS
myMQTTClient.configureCredentials(root_ca_path, private_key_path, certificate_path)

#Variable Declaration
DHT_SENSOR = Adafruit_DHT.DHT11
DHT_PIN = 17

# LED
LED_PIN = 23
GPIO.setmode(GPIO.BCM)
GPIO.setup(LED_PIN, GPIO.OUT)

pir = MotionSensor(4)

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(15,GPIO.IN)

# Create the I2C bus
i2c = busio.I2C(board.SCL, board.SDA)

# Create the ADC object using the I2C bus
ads = ADS.ADS1115(i2c)
ads.gain = 1

# Create single-ended input on channel 0
chan = AnalogIn(ads, ADS.P0)

### Work Time | Hardware/system: 2
def worksensors():
    check = 0
    while (check < 5):
        fire = "false"
        hu, temp = Adafruit_DHT.read_retry(DHT_SENSOR, DHT_PIN)
        if hu is not None and temp is not None:
            msg = ("Temp={0:0.1f}C Humidity={1:0.1f}%".format(temp,hu))
        else:
            print("Sensor failure. Check wiring")
        print(msg)
        fire = "false"
        if GPIO.input(15) == False:
            msg = ("FIRE")
            fire = "true"
        else:
            msg = ("no fire")

        print(msg)
        gasvoltage = chan.voltage
        if gasvoltage is not None:
            msg = ("Voltage: " + str(chan.voltage))
        else:
            print("Sensor failure. Check wiring")
        print(msg)
        timestamp = datetime.datetime.now().strftime("%m/%d/%Y, %H:%M:%S")
        client.publish("raspi/DHT11", payload=json.dumps({"timestamp": timestamp, "temp": temp, "hu": hu }), qos=0, retain=False)    
        client.publish("raspi/fire", payload=json.dumps({"timestamp": timestamp, "fire": fire }), qos=0, retain=False)    
        client.publish("raspi/gas", payload=json.dumps({"timestamp": timestamp,"gas": gasvoltage }), qos=0, retain=False)    
        time.sleep(3)
        check = check + 1
        
### Off Work Turn On Security | Hardware/system: 3
def securitysensors():
    check = 0
    while (check < 4):
        fire = "false"
        if GPIO.input(15) == False:
            msg = ("FIRE")
            fire = "true"
        else:
            msg = ("no fire")

        print(msg)
        gasvoltage = chan.voltage
        if gasvoltage is not None:
            msg = ("Voltage: " + str(chan.voltage))
        else:
            print("Sensor failure. Check wiring")
        print(msg)
        move = "false"
        if pir.wait_for_no_motion(2):
            msg = ("Movement !")
            move = "true"
        else:
            msg = ("nothing")
        print(msg)
        timestamp = datetime.datetime.now().strftime("%m/%d/%Y, %H:%M:%S")
        client.publish("raspi/fire", payload=json.dumps({"timestamp": timestamp, "fire": fire }), qos=0, retain=False)  
        client.publish("raspi/gas", payload=json.dumps({"timestamp": timestamp,"gas": gasvoltage }), qos=0, retain=False)    
        client.publish("raspi/move", payload=json.dumps({"timestamp": timestamp, "move": move }), qos=0, retain=False)  
        
        time.sleep(3)
        check = check + 1
        
def callback(client, userdata, message):
    global status_received
    global status
    #print("Received a new message: ")
    payload_str = message.payload.decode("utf-8")  # Decode the payload bytes to a string
    payload_dict = json.loads(payload_str)  # Parse the JSON string to a dictionary
    status = payload_dict.get("status")  # Get the value of the "status" field
    status_received = True  # Set the flag when status is received
    
    return
    

status_received = False
status = ""

### User check | Hardware/system: 1
def bTempPublishData():
    global status_received
    global status
    myMQTTClient.connect()
    subscriberes = myMQTTClient.subscribe(topic, 1, callback)

    
    check = 0
    user = input("Enter username:")
    while (check < 1):
        hu, temp = Adafruit_DHT.read_retry(DHT_SENSOR, DHT_PIN)
        if hu is not None and temp is not None:
            msg = ("Temp={0:0.1f}C".format(temp))
        else:
            print("Sensor failure. Check wiring")
        print(msg)
        timestamp = datetime.datetime.now().strftime("%m/%d/%Y, %H:%M:%S")
        client.publish("raspi/btemp", payload=json.dumps({"timestamp": timestamp,"user":user,"temp": temp }), qos=0, retain=False)    
        #pause time
        time.sleep(1)
        check = check + 1
    if subscriberes:
        print("waiting for confirmation:")
    else:
        print("Failed to subscribe to topic")

    time.sleep(3)

    while not status_received:
        pass
        
    if status == "on":
        GPIO.output(LED_PIN, GPIO.HIGH)
        time.sleep(3)
        print("All Clear")
        print("")
        GPIO.output(LED_PIN, GPIO.LOW)
    status = ""
    
    time.sleep(1)
    

def signal_handler(signal, frame):
    global status_received
    if status_received:
        print("Thanks!")
    else:
        print("Done.")
    exit(0)


status_received2 = False
st2 = ""
def callbackforstatus(client, userdata, message):
    global status_received2
    global st2
    #print("Received a new message: ")
    payload_str = message.payload.decode("utf-8")  # Decode the payload bytes to a string
    payload_dict = json.loads(payload_str)  # Parse the JSON string to a dictionary
    st2 = payload_dict.get("status")  # Get the value of the "status" field
    status_received2 = True  # Set the flag when status is received
    return
    
### Web control | Hardware/system: 4
def changestatus():
    
    global status_received2
    global st
    myMQTTClient.connect()
    subscriberes2 = myMQTTClient.subscribe(topic2, 1, callbackforstatus)
    if subscriberes2:
        print("waiting for confirmation:")
    else:
        print("Failed to subscribe to topic")

    while not status_received2:
        pass
    time.sleep(1)
    return
    
    




while (True):
    print("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n")
    print("Enter Number of action \n1: User check in\n2: Work Time \n3: Off Work Turn On Security \n4: Web control \n5: Turn Off System")
    userinput = input("Choose action: ")
    print("")
    status_received = False
    if userinput == "1":
        bTempPublishData()
    elif userinput == "2":
        worksensors()
    elif userinput == "3":
        securitysensors()
    elif userinput == "4":
        changestatus()
        if st2 == "on":
            print("Work Time ON")
            worksensors()
        elif st2 == "off":
            print("Security ON")
            securitysensors()
    elif userinput == "5":
        print("Thank you bye!")
        break



# _thread.start_new_thread(publishData,("Spin-up new Thread...",))

# client.loop_forever()
