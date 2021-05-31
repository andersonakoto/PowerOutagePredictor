import json
import os
import flask
import pandas as pd
import tensorflow as tf
from tensorflow.keras.models import Sequential, load_model
import requests
from sklearn import preprocessing
import numpy as np
from sklearn.preprocessing import StandardScaler
from sklearn.pipeline import Pipeline
from flask_cors import CORS

with open('map.geojson') as f:
    data = json.load(f)

p = 0

# load the model, and pass in the custom metric function
global graph
graph = tf.compat.v1.get_default_graph()
model = load_model('final_model')

data22 = []


for feature in data['features']:
    latlng =  str(feature['geometry']['coordinates'])[1:-1]
    p += 1
    # print (coords1, a)

    url2 = "https://api.weatherstack.com/current?access_key=26cfb70e26188eb94cc13769b423c011&query={}".format(latlng)

    response = requests.get(url2).json()
    temp = response["current"]["temperature"]
    wind_speed = response["current"]["wind_speed"]  
    precip = response["current"]["precip"]
    pressure = response["current"]["pressure"]
    humidity = response["current"]["humidity"]

    a= np.array([[temp,precip,wind_speed,pressure,humidity]])

    prd = model.predict(a)

    newprd = str(''.join(map(str, prd)))[1:-1]

    lng, lat = latlng.split(', ')

    data22.append({'lat' : lat,'lng' : lng, 'likelihood' : newprd})

    
    print(p,temp,precip,wind_speed,pressure,humidity,newprd)


json_dict = {}
json_dict = data22

with open('pred_data.json', 'w') as outfile:
    json.dump(json_dict, outfile, indent = 4)

# print(data22)