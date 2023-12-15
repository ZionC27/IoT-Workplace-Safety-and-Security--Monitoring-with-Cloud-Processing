# IoT Workplace Safety and Security, Monitoring with Cloud Processing


# Project Overview

This project primarily focuses on demonstrating the integration of cloud processing and monitoring capabilities to efficiently manage sensor data. It showcases a system that adeptly collects sensor data and transmits it to a cloud infrastructure. The utilization of various cloud services enables effective processing and storage of this data.

## Key Features

- **Cloud Integration:** Efficiently collects and transmits sensor data to the cloud for processing and storage.

- **Cloud Services Utilization:** Utilizes various cloud services for data processing and storage.

- **Visualization through Website Interface:** Showcases stored data visually via a website interface, enabling insights and informed decision-making.

- **Analytics Tools Integration:** Incorporates analytics tools for data analysis, providing deeper insights.

- **Raspberry Pi Control:** Demonstrates the system's capability to control the Raspberry Pi, triggering specific actions, highlighting its versatility and control over the IoT environment.

## Project Components

1. **Sensor Data Management:** Efficiently manages data collected from various sensors.

2. **Cloud Processing and Storage:** Utilizes cloud services for processing and storing sensor data.

3. **Data Visualization:** Showcases data through a website interface for visual representation.

4. **Analytics and Insights:** Integrates analytics tools for deeper data analysis and insights.

5. **Remote Control Functionalities:** Enables control over the Raspberry Pi, showcasing the system's comprehensive capabilities.

This project serves as a comprehensive solution merging sensor data management, cloud processing, visualization, and remote control functionalities, highlighting the potential and versatility of IoT applications in real-world scenarios.


# System Overview

## Hardware/System

Upon running the Ctrl Board on the Pi, users are presented with the following options:

1. **User check-in**
   - Allows users to check in by entering their name and obtaining a temperature reading.
   - Data is sent via MQTT protocol to AWS IoT Core, then directed to a Lambda function for processing.
     - Lambda function evaluates user temperature for suitability to work.
     - Processed data is saved to DynamoDB. User receives a message confirming clearance.
     - LED on the board lights up if the user is cleared.

2. **Work Time**
   - Activates DHT11, MQ-2 Gas, and flame sensors.
   - Sensor data is sent to an AWS Lambda function for processing and storage in DynamoDB.
   - If fire is detected by the flame sensor, triggers an AWS SNS topic to send an email alert.

3. **Off Work Turn On Security**
   - Activates MQ-2 Gas, motion/collision, and flame sensors.
   - Sensor data sent to AWS Lambda function for processing and storage in DynamoDB.

4. **Web Control**
   - Waits for an MQTT message.
   - Triggers either the "Work Time" or "Off Work Turn On Security" function based on the received message.

5. **Turn Off System**
   - Terminates all connections and closes the program.

## Cloud Processing & Monitoring (AWS Services)

1. **AWS IoT Core**
   - Uses MQTT for sending/receiving messages.
   - IoT Rules direct data to specific services (Lambda, IoT Analytics).

2. **Lambda Function**
   - Processes IoT data, sends it to DynamoDB, and triggers events (AWS SNS).

3. **AWS Analytics**
   - Utilizes IoT Analytics Channel, Pipeline, and Data Store to store raw data in an S3 bucket.
   - SageMaker enables data analysis through a Jupyter Notebook instance.

## Website (PHP-based)

1. **Login and Sign-up Pages**
   - User authentication for system access.

2. **Main Page**
   - Displays processed data stored in DynamoDB.
   - Provides buttons for users to control work mode.

## Flow Chart:
![IOT Project](https://github.com/ZionC27/IoT-Workplace-Safety-and-Security--Monitoring-with-Cloud-Processing/assets/56661548/1563438d-a8e9-49d6-bb72-3b534a14d887)

## Hardware Components:

- **Raspberry Pi:** Microcontroller acting as the system's brain.

- **DHT11 Temperature / Humidity Sensor:** Detects surrounding temperature and humidity.

- **Flame Sensor:** Detects the presence of a flame in front of the sensor.

- **MQ-2 Gas Sensor:** Detects various gases like LPG, i-butane, propane, methane, alcohol, Hydrogen, and smoke in the surrounding.

- **Collision Sensor:** Detects collisions with the sensor.

- **LED:** Light emitting diode.

- **ADC (Analog to Digital Converter):** Converts analog signals to digital.

## Technologies and Services:

- **MQTT (MQ Telemetry Transport) Protocol:** Lightweight, publish-subscribe, machine-to-machine network protocol, primarily used in IoT.

- **AWS IoT Core:** Managed cloud service facilitating secure communication between IoT devices and the AWS Cloud through MQTT.

- **AWS IoT Analytics:** Processes and analyzes IoT data at scale, enabling data collection, storage, processing, querying, and integration with other AWS services for comprehensive analytics.

- **AWS DynamoDB:** Fully managed NoSQL database service providing seamless scalability, high availability, and low-latency data storage and retrieval.

- **AWS SageMaker:** Platform for building, training, and deploying machine learning models at scale.

- **Amazon S3 (Simple Storage Service):** Scalable, secure, highly available object storage service for storing and retrieving any amount of data.

- **AWS Lambda:** Serverless computing service allowing code execution without server management.

- **AWS SNS (Simple Notification Service):** Fully managed messaging service for publishing and delivering messages to endpoints or distributed systems.

- **IAM (Identity and Access Management) User:** Represents a person or application in the AWS environment, granting specific permissions based on policies assigned by an AWS account administrator.

- **User-end Website:** Monitors and allows admin users to view employee health and workplace conditions. Implements security features like Strong Password Rule, Hashing, and Session Control.

    - **Strong Password Rule:** Requires users to input a strong password with uppercase, numbers, and symbols for signup.

    - **Hashing:** Converts plaintext passwords into irreversible hashed values before saving in the database, enhancing security.

    - **Session Control:** Authenticates, authorizes users, manages session timeouts, implements secure protocols (like HTTPS), and monitors for suspicious activities or unauthorized access within user sessions.
 
## Circuitry:
![IMG_0087](https://github.com/ZionC27/IoT-Workplace-Safety-and-Security--Monitoring-with-Cloud-Processing/assets/56661548/792e522f-2fb6-4552-9c81-e3d35ee0a6ed)


Contributors for website: Kenichi, Gustavo, Thien
