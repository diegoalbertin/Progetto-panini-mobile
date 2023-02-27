
function setOrder(user_id, totalPrice, products, productOnJson)
{
  const breakValue = document.getElementById('btnBreak').value;
  const pickupValue = document.getElementById('btnPickup').value;
  if(breakValue!="BREAK"&&pickupValue!="PICKUP" ){
    let json = `{
      "user":"${user_id}",
      "break": "${breakValue}",
      "status": "1",
      "pickup": "${pickupValue}",
      "products": 
              ${JSON.stringify(products)}
          ,
      "json": {
      "user": "${user_id}",
      "totalPrice" : "${totalPrice}",
      "break": "${breakValue}",
      "status": "1",
      "pickup": "${pickupValue}",
      "products": ${JSON.stringify(productOnJson)}
      }
   }`;

   const requestOptions = {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(JSON.parse(json)),
    };

    fetch(getPath().concat('/API/order/setOrder.php'), requestOptions)
    .then((response) => {
      if (response.ok) {
          return response.json();
      }
      throw new Error(response.data);
    })
    .then((data) => {
      products.forEach(product => {
          console.log(product);
          fetch(getPath().concat('/API/cart/deleteItem.php?user='.concat(user_id).concat('&product=').concat(product['ID'])))
          .then((response) => response.json())
          .then((data) => {
          })
      });
      console.log(data);
      alert('ordinato');
      location.href = "index.php";
    })
    .catch((e) => {document.querySelector('#error').innerHTML = "Seleziona punto di ritiro e/o ricreazione"})

  }else{
    alert("error");
  }
}