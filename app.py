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
from flask_cors import CORS, cross_origin
import africastalking
from flask import Flask, render_template, request, redirect, url_for, session, flash
from flask_mysqldb import MySQL
import MySQLdb.cursors
import re
import random


# instantiate flask 
app = flask.Flask(__name__)

cors = CORS(app)

# Change this to your secret key (can be anything, it's for extra protection)
app.secret_key = 'mykey1'

# Enter your database connection details below
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'popredictor'

# Intialize MySQL
mysql = MySQL(app)



# http://localhost:5000/pythinlogin/home - this will be the home page, only accessible for loggedin users
@app.route('/usrlogin', methods=['GET', 'POST'])
def usrlogin():
    msg = ''

    # Output message if something goes wrong...
    # Check if "username" and "password" POST requests exist (user submitted form)
    if request.method == 'POST' and 'phonenumber' in request.form:
        # Create variables for easy access
        phonenumber = request.form['phonenumber']
        # Check if account exists using MySQL
        cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute('SELECT * FROM user_accounts WHERE user_phone = %s', (phonenumber,))
        # Fetch one record and return result
        account = cursor.fetchone()
        # If account exists in accounts table in out database
        if account:
            session['phonenumber'] = account['user_phone']

            class send_sms():

                def __init__ (self):
                    self.username = 'andersonakoto'
                    self.api_key = '3e69c32fbcd6cf339d6d663b5d809fbab7bf6880501b0dc07e961fcd33f443cb'
     
                    africastalking.initialize(self.username, self.api_key)
    
                    self.sms = africastalking.SMS
      
      
                def sending(self):
                    recipients = [phonenumber]
                    pcode = random.randrange(100000, 999999)
                    
                    cursor.execute("UPDATE user_accounts SET user_passcode = %s, login_status = 'no' WHERE user_phone = %s", (pcode, phonenumber,))
                    mysql.connection.commit()

                  # Set your message
                    message = pcode
                              # Set your shortCode or senderId
                    sender = "PINESS"
                    
                    try:
                        response = self.sms.send(message, recipients, sender)
                        print (response)
                    except Exception as e:
                        print (f'Houston, we have a problem: {e}')
                  
            send_sms().sending()
            return render_template('putcode.html', msg = msg)
        else:
            # Check if account exists using MySQL
            cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
            
            cursor.execute("INSERT INTO user_accounts (user_id, user_phone, login_status, user_passcode, login_time) VALUES ('', %s, 'no', '', '')", (phonenumber,))
            session['phonenumber'] = account['user_phone']

            mysql.connection.commit()

            class send_sms():

                def __init__ (self):
                    self.username = 'andersonakoto'
                    self.api_key = '3e69c32fbcd6cf339d6d663b5d809fbab7bf6880501b0dc07e961fcd33f443cb'
     
                    africastalking.initialize(self.username, self.api_key)
    
                    self.sms = africastalking.SMS
      
      
                def sending(self):
                    recipients = [phonenumber]
                    pcode = random.randrange(100000, 999999)
                    cursor.execute('UPDATE user_accounts SET user_passcode = %s WHERE user_phone = %s', (pcode, phonenumber,))
                    mysql.connection.commit()

                   # Set your message
                    message = pcode
                               # Set your shortCode or senderId
                    sender = "PINESS"
                     
                    try:
                        response = self.sms.send(message, recipients, sender)
                        print (response)
                    except Exception as e:
                        print (f'Houston, we have a problem: {e}')
                   
            send_sms().sending()

            return render_template('putcode.html', msg = msg)

    return render_template('login.html')







# http://localhost:5000/pythinlogin/home - this will be the home page, only accessible for loggedin users
@app.route('/putcode', methods=['GET', 'POST'])
def putcode():
    msg = ''

    # Output message if something goes wrong...
    # Check if "username" and "password" POST requests exist (user submitted form)
    if request.method == 'POST' and 'passcode' in request.form:
        # Create variables for easy access
        passcode = request.form['passcode']

        phonenumber = session.get('phonenumber', None)
        # Check if account exists using MySQL
        cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute('SELECT * FROM user_accounts WHERE user_passcode = %s AND user_phone = %s', (passcode,phonenumber))
        # Fetch one record and return result
        account = cursor.fetchone()
                # If account exists in accounts table in out database
        if account:
            # Create session data, we can access this data in other routes
            session['loggedin'] = True
            session['phonenumber'] = account['user_phone']
            session['id'] = account['user_id']
            session['logintime'] = account['login_time']
            cursor.execute("UPDATE user_accounts SET login_status = 'yes', login_time = NOW(), user_passcode = '' WHERE user_phone = %s", (phonenumber,))
            mysql.connection.commit()

            return redirect(url_for('general'))
            
        else:
            msg = 'Incorrect passcode'
            return render_template('putcode.html', msg = msg)

    return render_template('putcode.html', msg=msg)

@app.route('/logout')
def logout():
    session.pop('loggedin', None)
    session.pop('phonenumber', None)
    session.pop('id', None)
    session.pop('logintime', None)
    return redirect(url_for('usrlogin'))



# load the model, and pass in the custom metric function
global graph
graph = tf.compat.v1.get_default_graph()
model = load_model('final_model')

url1 = "http://api.weatherstack.com/current?access_key=26cfb70e26188eb94cc13769b423c011&query=fetch:ip"

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


@app.route('/wind-freq', methods=["GET"])
def windfreq():
    return flask.render_template('wind-freq.html')

@app.route('/rain-freq', methods=["GET"])
def rainfreq():
    return flask.render_template('rain-freq.html')

@app.route('/time-series', methods=["GET"])
def timeseries():
    return flask.render_template('time-series.html')

@app.route('/likelihood-pred', methods=["GET"])
def likelihoods():
    return flask.render_template('likelihood-pred.html') 

@app.route('/general', methods=["GET"])
def general():
    return flask.render_template('general.html')    

@app.route('/profile', methods=["GET"])
def profile():
    return flask.render_template('profile.html')  

@app.route('/chart', methods=["GET"])
def chart():
    return flask.render_template('chart.html')                

# start the flask app, allow remote connections 
if __name__ == "__main__":
    app.run(host='0.0.0.0', port=8000, debug=True)