import os

from wowsmm import WowSMM

api = WowSMM(os.environ.get("WOWSMM_API_KEY", "YOUR_API_KEY"))

print(api.balance())
print(api.services()[:5])

order = api.order(1, "https://www.instagram.com/your_profile/", 100)
print(order)

if "order" in order:
    print(api.status(order["order"]))
