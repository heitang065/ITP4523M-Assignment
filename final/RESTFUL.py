from flask import Flask
from datetime import datetime as dt

app = Flask(__name__)

@app.route("/api/discountCalculator/<accountCreationDate>")
def process(accountCreationDate=None):
    DAYS_IN_ONE_YEAR = 365.25
    startDate = dt.strptime(accountCreationDate, "%Y-%m-%d")
    now = dt.today()
    days = (now - startDate).days
    years = int(days / DAYS_IN_ONE_YEAR)

    if years > 3:
        discount = 0.3
    elif years > 2:
        discount = 0.2
    elif years > 1:
        discount = 0.1
    else:
        discount = 0
    response_data = {"discount": discount}
    return response_data


if __name__ == "__main__":
    app.run(debug=True,
            host='127.0.0.1',
            port=8080)
