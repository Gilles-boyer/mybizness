var myHeaders = new Headers();


export default {
  goToPaiement(
    clientPhone,
    clientEmail,
    clientLastName,
    clientFirstName,
    total,
    description
  ) {

    myHeaders.append(
      "Referer",
      "https://cte.vosfactures.fr/products/3cdwvI6x4Vy9PEzXxAU/autopayment"
    );
    myHeaders.append("Origin", "https://cte.vosfactures.fr");
    myHeaders.append("Host", "cte.vosfactures.fr");
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
    myHeaders.append(
      "Cookie",
      "_firmlet_session_v2=elBUZ0l2VS9leVRGVUpBN3YyWllaTm5zSVVxYk5rMDZ1cFZabXhLd3RqL1lNZjZIakJUWGZuL0pUa1ZvSVR4ZHhxTEh1NGVPVjRySWtsZEJCODlSK0FaRm9HdmlWWTBZdndSL1NseUFLSzNkeFFFVzhtYUxhYW5NeVN4OXFQSzNKQ0ZzckNKckhZZVpOY09HR1JZSnora1RpMjRsVytVdUV6d3hTMEhlSTRZczJpbVJDNkpIZmdLdmQ0aEdCZkVUT1BDVlN5UU1PZGxDSGJjckdUUG1DaUNKbUMrRU1NUWF0L1EzQTVhZVJ0T0FFM1NYNGtuSzdmZUhNOFBTVDZPYzFRSlZCeForajRic1ZaaWJqNXVkSHhEMUtHSHJtNDBJdGg3UFZ3ZlBTYmc5RGlkdlNQeHJ3R1lGMUF0bWFYV3ItLXRjL0ZqNVdqaE9wUWNMeWtPUzNTVWc9PQ%3D%3D--bd7d224024f654f8d113139285529be7e29a0dd5"
    );

    var urlencoded = new URLSearchParams();
    urlencoded.append("payment[kind]", "autopayment");
    urlencoded.append("payment[account_id]", "598713");
    urlencoded.append("payment[name]", "bon cadeau");
    urlencoded.append("payment[product_id]", "91486208");
    urlencoded.append("payment[provider]", "stripe");
    urlencoded.append("payment[price]", total.toString());
    urlencoded.append("payment[description]", description);
    urlencoded.append("payment[referrer]", "https://cte.vosfactures.fr/");
    urlencoded.append("payment[first_name]", clientFirstName);
    urlencoded.append("payment[last_name]", clientLastName);
    urlencoded.append("payment[email]", clientEmail);
    urlencoded.append("payment[generate_invoice]", "1");
    urlencoded.append("lang", "fr");
    urlencoded.append("payment[phone]", clientPhone);

    var requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: urlencoded,
      redirect: "follow",
    };

    return requestOptions;
  },
};
