import boto3

client = boto3.client('iotanalytics')
dataset = "dht11_dataset"
dataset_url = client.get_dataset_content(datasetName=dataset)['entries'][0]['dataURI']
dataset_url

import pandas as pd
import matplotlib.pyplot as plt

df = pd.read_csv(dataset_url, header=0)
df.plot(x='timestamp',y='temp')
plt.xlabel('Time')
plt.ylabel('Temperature')
plt.xticks(rotation=45)  # Rotate x-axis labels for better readability
plt.tight_layout()
plt.show()
