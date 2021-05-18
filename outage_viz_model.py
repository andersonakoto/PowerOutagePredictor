import numpy as np
import pandas as pd
import json

with open("map.geojson") as f:
    data = json.load(f)

url = "http://api.weatherstack.com/current?access_key=26cfb70e26188eb94cc13769b423c011&query=fetch:ip"

for i in range(len(data["features"])):
    properties = data["features"][i]["geometry"]

    coords = np.array(properties["coordinates"])

    # print("Record %d: Coords %s"
    #  % (i,properties ["coordinates"]))

    print(coords)
