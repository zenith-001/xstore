document.querySelector(".filterbtn").onclick = function () {
  document.querySelector(".filterNav").style.left = "0px";
};

document.querySelector(".filtercls").onclick = function () {
  document.querySelector(".filterNav").style.left = "-500px";
};

document.getElementsByName("device")[0].value = `<?php echo $device ?>`;
document.getElementsByName("brand")[0].value = `<?php echo $brand ?>`;
document.getElementsByName("color")[0].value = `<?php echo $color ?>`;
document.getElementsByName("min_ram")[0].value = `<?php echo $min_ram ?>`;
document.getElementsByName(
  "min_storage"
)[0].value = `<?php echo $min_storage ?>`;
document.getElementsByName("min_price")[0].value = `<?php echo $min_price ?>`;
document.getElementsByName("max_ram")[0].value = `<?php echo $max_ram ?>`;
document.getElementsByName(
  "max_storage"
)[0].value = `<?php echo $max_storage ?>`;
document.getElementsByName("max_price")[0].value = `<?php echo $max_price ?>`;

function removeFilter(txt) {
  form = document.createElement("form");
  form.method = "POST";
  form.action = "shop.php";
  device = document.createElement("input");
  device.name = "device";
  device.setAttribute("value", "<?php echo $device ?>");
  brand = document.createElement("input");
  brand.name = "brand";
  brand.setAttribute("value", "<?php echo $brand ?>");
  color = document.createElement("input");
  color.name = "color";
  color.setAttribute("value", "<?php echo $color ?>");
  max_ram = document.createElement("input");
  max_ram.name = "max_ram";
  max_ram.setAttribute("value", "<?php echo $max_ram ?>");
  min_ram = document.createElement("input");
  min_ram.name = "min_ram";
  min_ram.setAttribute("value", "<?php echo $min_ram ?>");
  min_storage = document.createElement("input");
  min_storage.name = "min_storage";
  min_storage.setAttribute("value", "<?php echo $min_storage ?>");
  max_storage = document.createElement("input");
  max_storage.name = "max_storage";
  max_storage.setAttribute("value", "<?php echo $max_storage ?>");
  min_price = document.createElement("input");
  min_price.name = "min_price";
  min_price.setAttribute("value", "<?php echo $min_price ?>");
  max_price = document.createElement("input");
  max_price.name = "max_price";
  max_price.setAttribute("value", "<?php echo $max_price ?>");

  if ((txt = "device")) {
    device.setAttribute("value", "");
  }
  if ((txt = "brand")) {
    brand.setAttribute("value", "");
  }
  if ((txt = "color")) {
    color.setAttribute("value", "");
  }
  if ((txt = "ram")) {
    min_ram.setAttribute("value", "");
    max_ram.setAttribute("value", "");
  }
  if ((txt = "storage")) {
    min_storage.setAttribute("value", "");
    max_storage.setAttribute("value", "");
  }
  if ((txt = "price")) {
    min_price.setAttribute("value", "");
    max_price.setAttribute("value", "");
  }
  document.body.appendChild(form);
  inp = document.createElement("input");
  inp.name = "filterer";
  inp.value = "filterer";

  form.submit();
  // location.reload();
}
