#!/usr/bin/env python

from statistics import stdev
import json
import sys

conjunto = (1, 2, 5, 4, 8, 9, 12) 

def deviation(conjunto):
    return json.dumps(stdev(conjunto))

print(deviation(conjunto))