import json
import urllib.parse
import urllib.request


class WowSMM:
    URL = "https://wowsmm.com/api/v2"

    def __init__(self, key):
        self.key = key

    def services(self):
        return self._call({"action": "services"})

    def order(self, service, link, quantity, **extra):
        data = {"action": "add", "service": service, "link": link, "quantity": quantity}
        data.update(extra)
        return self._call(data)

    def status(self, order):
        return self._call({"action": "status", "order": order})

    def multi_status(self, orders):
        return self._call({"action": "status", "orders": ",".join(str(o) for o in orders)})

    def refill(self, order):
        return self._call({"action": "refill", "order": order})

    def cancel(self, orders):
        return self._call({"action": "cancel", "orders": ",".join(str(o) for o in orders)})

    def balance(self):
        return self._call({"action": "balance"})

    def _call(self, data):
        data["key"] = self.key
        body = urllib.parse.urlencode(data).encode()
        req = urllib.request.Request(self.URL, data=body, headers={"User-Agent": "WowSMM-Python/1.0"})
        with urllib.request.urlopen(req, timeout=30) as res:
            return json.loads(res.read().decode())
