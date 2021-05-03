import os
import flask
import pandas as pd
import tensorflow as tf
from tensorflow.keras.models import Sequential, load_model
import requests
from sklearn import preprocessing
import numpy as np
from sklearn.preprocessing import StandardScaler
import json
from sklearn.pipeline import Pipeline


# instantiate flask 
app = flask.Flask(__name__)

# load the model, and pass in the custom metric function
global graph
graph = tf.compat.v1.get_default_graph()
model = load_model('final_model')

url = "http://api.weatherstack.com/current?access_key=26cfb70e26188eb94cc13769b423c011&query=-1.288077,36.819927"
# homepage
@app.route("/templates", methods=["GET"])
def homepage():
    return flask.render_template("index.html")


#trained keras model
model = load_model('final_model.h5')


@app.route("/predict", methods=["GET"])
def predict():
    # temp = flask.request.form['lat']
    # press = flask.request.form['lng'] 
    
    
    response = requests.get(url).json()
    temp = response["current"]["temperature"]
    wind_speed = response["current"]["wind_speed"]  
    precip = response["current"]["precip"]
    pressure = response["current"]["pressure"]
    humidity = response["current"]["humidity"]


    a= np.array([[temp,precip,wind_speed,pressure,humidity]])

    prd = model.predict(a)

    newprd = ''.join(map(str, prd))

    return flask.render_template('index.html', prediction_text=f'Likelihood of a power outage: {newprd}')    
    
    
    
# start the flask app, allow remote connections 
if __name__ == "__main__":
    app.run(host='0.0.0.0', port=8000)