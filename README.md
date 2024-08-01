# IoT Workplace Safety and Security Monitoring with Cloud Processing

## Introduction
This project demonstrates the integration of cloud processing and monitoring capabilities to manage sensor data effectively. It highlights a system designed to collect sensor data, process it through cloud infrastructure, and visualize the results via a web interface.

## Table of Contents
1. [Project Overview](#project-overview)
2. [System Overview](#system-overview)
3. [Flow Chart](#flow-chart)
4. [Hardware Components](#hardware-components)
5. [Technologies and Services](#technologies-and-services)
6. [Circuitry](circuitry)

## Project Overview

**Key Features:**
- **Cloud Integration:** Efficiently collects and transmits sensor data to the cloud for processing and storage.
- **Cloud Services Utilization:** Utilizes various cloud services for data processing and storage.
- **Visualization through Website Interface:** Showcases stored data visually via a website interface, enabling insights and informed decision-making.
- **Analytics Tools Integration:** Incorporates analytics tools for data analysis, providing deeper insights.
- **Raspberry Pi Control:** Demonstrates the system's capability to control the Raspberry Pi, triggering specific actions, highlighting its versatility and control over the IoT environment.

**Contributors:**
- AWS Design/Code and Raspberry Pi Hardware/Code: [Zion](https://github.com/ZionC27)
- Website Development: Kenichi, Gustavo, Thien


## System Overview
### Hardware/System
- **User Check-In:** Collects temperature data and evaluates user suitability.
- **Work Time:** Monitors environmental factors during work hours.
- **Off Work Turn On Security:** Activates sensors for security when off work.
- **Web Control:** Responds to MQTT messages to control system functions.
- **Turn Off System:** Closes all connections and terminates the program.

### Cloud Processing & Monitoring (AWS Services)

1. **AWS IoT Core**
   - Uses MQTT for sending/receiving messages.
   - IoT Rules direct data to specific services (Lambda, IoT Analytics).

2. **Lambda Function**
   - Processes IoT data, sends it to DynamoDB, and triggers events (AWS SNS).

3. **AWS Analytics**
   - Utilizes IoT Analytics Channel, Pipeline, and Data Store to store raw data in an S3 bucket.
   - SageMaker enables data analysis through a Jupyter Notebook instance.

### Website (PHP-based)

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

- **MQ-2 Gas Sensor:** Detects various gases like LPG, i-butane, propane, methane, alcohol, Hydrogen, and smoke in the surroundings.

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
