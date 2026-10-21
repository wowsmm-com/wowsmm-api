const WowSMM = require("./wowsmm");

const api = new WowSMM(process.env.WOWSMM_API_KEY || "YOUR_API_KEY");

(async () => {
  console.log(await api.balance());
  const services = await api.services();
  console.log(services.slice(0, 5));
  const order = await api.order(1, "https://www.instagram.com/your_profile/", 100);
  console.log(order);
  if (order.order) console.log(await api.status(order.order));
})();
