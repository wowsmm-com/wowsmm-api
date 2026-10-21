const URL_API = "https://wowsmm.com/api/v2";

class WowSMM {
  constructor(key) {
    this.key = key;
  }

  services() {
    return this.call({ action: "services" });
  }

  order(service, link, quantity, extra = {}) {
    return this.call({ action: "add", service, link, quantity, ...extra });
  }

  status(order) {
    return this.call({ action: "status", order });
  }

  refill(order) {
    return this.call({ action: "refill", order });
  }

  cancel(orders) {
    return this.call({ action: "cancel", orders: orders.join(",") });
  }

  balance() {
    return this.call({ action: "balance" });
  }

  async call(data) {
    const body = new URLSearchParams({ ...data, key: this.key });
    const res = await fetch(URL_API, { method: "POST", body });
    if (!res.ok) throw new Error("Request failed: " + res.status);
    return res.json();
  }
}

module.exports = WowSMM;
