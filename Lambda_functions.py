#DHT11_Function
import boto3

def lambda_handler(event, context):
    client = boto3.client('dynamodb')
    
    max_temperature = 25.0
    min_temperature = 18.0
    max_humidity = 60
    min_humidity = 40
    
    Condition = "N"

    if (event['temp'] > max_temperature and event['hu'] > max_humidity):
        Condition = "HTH"
    elif (event['temp'] < min_temperature and event['hu'] < min_humidity):
        Condition = "LTH"
    elif event['temp'] > max_temperature:
        Condition = "HT"
    elif event['hu']   > max_humidity:
        Condition = "HH"
    elif event['temp'] < min_temperature:
        Condition = "LT"
    elif event['hu']   < min_humidity:
        Condition = "LH"


    response = client.put_item(
        TableName = 'DHT11_data',
        Item = {
            'timestamp': {'S': event['timestamp']},
            'temp': {'N': str(event['temp'])},
            'hu': {'N': str(event['hu'])},
            'condition': {'S': Condition},
        }
    )

    return 0

###############################   
#DHT11_Function
import boto3
import json

def lambda_handler(event, context):
    iot_client = boto3.client('iot-data')
    client = boto3.client('dynamodb')
    
    status = ""
    if event['temp'] > 26:
        status = "N"
        message = {"status": "off"}
    else:
        status = "G"
        message = {"status": "on"}
    response = client.put_item(
        TableName = 'Btemp_data',
        Item = {
            'timestamp': {'S': event['timestamp']},
            'user': {'S': event['user']},
            'temp': {'N': str(event['temp'])},
            'status': {'S': status}
        }
    )
    
    # Convert the message to JSON format
    message_json = json.dumps(message)

    # Define the topic to which you want to publish the message
    topic = "raspi/DHT11"

    # Publish the message to the specified topic
    response = iot_client.publish(
        topic=topic,
        qos=1,  # Quality of Service level
        payload=message_json
    )

    return 0

###############################   
#Gas_Function
import boto3

def lambda_handler(event, context):
    client = boto3.client('dynamodb')
    status = ""
    if event['gas'] > 1.0 and event['gas'] < 1.2:
        status = "L"
    elif event['gas'] > 1.2:
        status = "H"

    else:
        status = "N"
    response = client.put_item(
        TableName = 'Gas_data',
        Item = {
            'timestamp': {'S': event['timestamp']},
            'status': {'S': status}
        }
    )

    return 0

###############################   
#Move_Function
import boto3

def lambda_handler(event, context):
    client = boto3.client('dynamodb')

    response = client.put_item(
        TableName = 'Move_data',
        Item = {
            'timestamp': {'S': event['timestamp']},
            'move': {'S': event['move']}
        }
    )

    return 0

###############################   
#Flame_Function
import boto3
import json

def lambda_handler(event, context):
    client = boto3.client('dynamodb')
    sns = boto3.client('sns')
    
    response = client.put_item(
        TableName = 'Flame_data',
        Item = {
            'timestamp': {'S': event['timestamp']},
            'fire': {'S': event['fire']}
        }
    )
    
    if event['fire'] == "true":
        message = "THERE IS A FIRE"
        sns.publish(TopicArn = 'arn:FireWarning',  Message = "THERE IS A FIRE")
        return {
            'statusCode': 200,
            'body': json.dumps('SNS notification sent.')
        }
    else:
        return 0
    
###############################   
# on and off function 
import boto3
import json

def lambda_handler(event, context):
    # Create an IoT client
    iot_client = boto3.client('iot-data')
    
    message = {
        "status": "off"  # Change this value to 'off' if needed
    }
    # Convert the message to JSON format
    message_json = json.dumps(message)

    # Define the topic to which you want to publish the message
    topic = "raspi/c"

    # Publish the message to the specified topic
    response = iot_client.publish(
        topic=topic,
        qos=1,  # Quality of Service level
        payload=message_json
    )

    return {
        'statusCode': 200,
        'body': json.dumps('Message sent to IoT Core successfully! this is the offffff')
    }
    