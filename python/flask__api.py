from flask import Flask, request, jsonify
from flask_cors import CORS
from api import Api
app = Flask(__name__)
CORS(app)


@app.route('/')
def hello_world():
    return 'Hello world'


@app.route('/knn', methods = ['POST'])
def knn():
    api = Api()
    data = request.json
    symptoms = data['symptoms']
    knn_result = api.knn_process(symptoms)
    return jsonify(knn_result)


if __name__ == '__main__':
    app.run()
