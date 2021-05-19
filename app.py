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
from flask_cors import CORS


# instantiate flask 
app = flask.Flask(__name__)
CORS(app)

# load the model, and pass in the custom metric function
global graph
graph = tf.compat.v1.get_default_graph()
model = load_model('final_model')

url1 = "http://api.weatherstack.com/current?access_key=26cfb70e26188eb94cc13769b423c011&query=fetch:ip"
# homepage
@app.route("/", methods=["GET"])
def homepage():

    response = requests.get(url1).json()
    temp = response["current"]["temperature"]
    wind_speed = response["current"]["wind_speed"]  
    precip = response["current"]["precip"]
    pressure = response["current"]["pressure"]
    humidity = response["current"]["humidity"]


    a= np.array([[temp,precip,wind_speed,pressure,humidity]])

    prd = model.predict(a)

    newprd = str(''.join(map(str, prd)))[1:-1]

    return flask.render_template('general.html', prediction_text=f'Likelihood of a power outage at your location(Based on IP): {newprd}')    

@app.route("/predict", methods=["GET"])
def predict():

    from flask import jsonify, request

    lat = str(request.args.get('lat'))
    
    lng = str(request.args.get('lng'))

    latlng = lat + ',' + lng

    url2 = "http://api.weatherstack.com/current?access_key=26cfb70e26188eb94cc13769b423c011&query={}".format(latlng)

    response = requests.get(url2).json()
    temp = response["current"]["temperature"]
    wind_speed = response["current"]["wind_speed"]  
    precip = response["current"]["precip"]
    pressure = response["current"]["pressure"]
    humidity = response["current"]["humidity"]


    a= np.array([[temp,precip,wind_speed,pressure,humidity]])

    prd = model.predict(a)

    newprd = str(''.join(map(str, prd)))[1:-1]


    return jsonify(newprd)


@app.route('/wind-freq.html', methods=["GET"])
def windfreq():
    return flask.render_template('wind-freq.html')

@app.route('/rain-freq.html', methods=["GET"])
def rainfreq():
    return flask.render_template('rain-freq.html')

@app.route('/time-series.html', methods=["GET"])
def timeseries():
    return flask.render_template('time-series.html')

@app.route('/outages_wind.html', methods=["GET"])
def wind():
    return flask.render_template('outages_wind.html')

# start the flask app, allow remote connections 
if __name__ == "__main__":
    app.run(host='192.168.100.95', port=8000, debug=True)