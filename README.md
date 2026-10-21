<p align="center">
  <img src="assets/logo.png" alt="WowSMM logo" width="160">
</p>

# WowSMM API Client (PHP, Python, Node.js)

Ready-to-use client code for the [WowSMM](https://wowsmm.com) SMM panel API v2. Connect your own SMM panel, child panel, Telegram bot or script to WowSMM and place orders, check status, request refills and read your balance automatically.

WowSMM is an SMM panel for Instagram, YouTube, Facebook, Telegram, TikTok, X (Twitter), WhatsApp channels and more, built for creators, agencies and SMM resellers.

- Website: https://wowsmm.com
- API documentation: https://wowsmm.com/api_docs
- SMM reseller panel guide: https://wowsmm.com/smm-reseller-panel
- Child panel guide: https://wowsmm.com/smm-child-panel

## API basics

| Item | Value |
| --- | --- |
| Endpoint | `https://wowsmm.com/api/v2` |
| Method | `POST` |
| Response | JSON |
| Auth | `key` parameter (your API key from the WowSMM API page after login) |

### Actions

| Action | Parameters | What it does |
| --- | --- | --- |
| `services` | none | List of services with rate, min, max, refill and cancel flags |
| `add` | `service`, `link`, `quantity` (+ optional fields per service type) | Places a new order |
| `status` | `order` or `orders` (comma separated) | Order status, start count, remains |
| `refill` | `order` | Requests a refill for services that support it |
| `cancel` | `orders` (comma separated) | Requests cancellation where the service allows it |
| `balance` | none | Current balance and currency |

## Quick start

Get your API key: log in to [WowSMM](https://wowsmm.com), open the API page and copy your key. Keep it private.

### PHP

```php
require 'php/WowSMM.php';

$api = new WowSMM('YOUR_API_KEY');
print_r($api->balance());
$order = $api->order(1, 'https://www.instagram.com/your_profile/', 100);
print_r($api->status($order['order']));
```

### Python

```python
from wowsmm import WowSMM

api = WowSMM("YOUR_API_KEY")
print(api.balance())
order = api.order(1, "https://www.instagram.com/your_profile/", 100)
print(api.status(order["order"]))
```

### Node.js (18+)

```js
const WowSMM = require("./node/wowsmm");

const api = new WowSMM("YOUR_API_KEY");
api.balance().then(console.log);
```

Service IDs in the examples are placeholders. Use the `services` action to get the real IDs.

## Use cases

- **SMM resellers:** sell WowSMM services on your own website at your own price.
- **Child panel owners:** add WowSMM as a provider in any panel script that supports the standard SMM panel v2 API.
- **Bots and automation:** place and track orders from a Telegram bot, CRM or Google Sheet script.

## Support

- WhatsApp: +91 92099 85698
- Telegram: [t.me/wow_smm_com](https://t.me/wow_smm_com)
- WhatsApp community: [join](https://chat.whatsapp.com/DH4vMJWaWWCKkLcMgdW5bI)
- YouTube: [youtube.com/@wowsmm_com](https://www.youtube.com/@wowsmm_com)
- Email: wowsmm2025@gmail.com

## License

MIT. See [LICENSE](LICENSE).
