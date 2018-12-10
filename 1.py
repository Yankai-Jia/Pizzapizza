from flask import Flask, json, jsonify
from flask import request, make_response
from flask_cors import CORS

import qa

app = Flask(__name__)

CORS(app)


# @app.route('/<question1>')
# def hello_world(question):
#     return 'Hello World! %s' % question

@app.route('/question')

def callback():
    # response = current_app.make_default_options_response()
    question = request.args.get('callback')
    qa1 = qa.ent(question)
    result_text = {'data': qa1}
    response = make_response(json.dumps(result_text))
    response.headers['Access-Control-Allow-Origin'] = '*'
    response.headers['Access-Control-Allow-Methods'] = 'OPTIONS,HEAD,GET,POST'
    response.headers['Access-Control-Allow-Headers'] = 'x-requested-with'
    return response


if __name__ == '__main__':
    app.run(debug=True)