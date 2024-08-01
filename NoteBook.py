import boto3

client = boto3.client('iotanalytics')
dataset = "dht11_dataset"
dataset_url = client.get_dataset_content(datasetName=dataset)['entries'][0]['dataURI']
dataset_url


import pandas as pd
import matplotlib.pyplot as plt
import numpy as np


data = {
    'timestamp': pd.date_range(start='2024-07-01', periods=100, freq='H'),
    'temp': np.random.uniform(low=15, high=30, size=100),  # Hypothetical temperature data
    'humidity': np.random.uniform(low=30, high=70, size=100)  # Hypothetical humidity data
}

# Creating a DataFrame
df = pd.DataFrame(data)

# Visualize Temperature vs. Humidity
plt.figure(figsize=(10, 5))
plt.scatter(df['temp'], df['humidity'], c='blue', label='Humidity')
plt.xlabel('Temperature (°C)')
plt.ylabel('Humidity (%)')
plt.title('Temperature vs. Humidity')
plt.legend()
plt.grid(True)
plt.tight_layout()
plt.show()

# Summary Statistics
summary_stats = df.describe()
print(summary_stats)

# Subplots: Temperature and Humidity over Time
fig, ax1 = plt.subplots(figsize=(12, 6))

color = 'tab:red'
ax1.set_xlabel('Time')
ax1.set_ylabel('Temperature (°C)', color=color)
ax1.plot(df['timestamp'], df['temp'], color=color)
ax1.tick_params(axis='y', labelcolor=color)
ax1.xaxis.set_major_formatter(plt.FixedFormatter(df['timestamp'].dt.strftime("%Y-%m-%d %H:%M:%S")))
ax1.tick_params(axis='x', rotation=45)

ax2 = ax1.twinx()
color = 'tab:blue'
ax2.set_ylabel('Humidity (%)', color=color)
ax2.plot(df['timestamp'], df['humidity'], color=color)
ax2.tick_params(axis='y', labelcolor=color)

fig.tight_layout()
plt.title('Temperature and Humidity over Time')
plt.show()
