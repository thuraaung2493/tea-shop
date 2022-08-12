import { Modal } from "bootstrap";

window.addEventListener("DOMContentLoaded", documentReady);

function documentReady() {
  document.querySelectorAll(".incrementBtn").forEach(function (ele) {
    ele.addEventListener("click", function (e) {
      let parent = this.parentElement;
      let input = parent.querySelector("input[type='text']");
      let value = +input.getAttribute("value");
      input.setAttribute("value", value + 1);
      let product = JSON.parse(parent.dataset.product);

      addProduct(product);
    });
  });

  document.querySelectorAll(".decrementBtn").forEach(function (ele) {
    ele.addEventListener("click", function () {
      let parent = this.parentElement;
      let input = parent.querySelector("input[type='text']");
      let value = +input.getAttribute("value");
      if (value > 0) {
        input.setAttribute("value", value - 1);
        let product = JSON.parse(parent.dataset.product);

        removeProduct(product);
      }
    });
  });

  document.getElementById("orderBtn").addEventListener("click", function () {
    calculateTotalPrice();

    let confirmModal = new Modal(document.getElementById("confirmModal"), {
      backdrop: "static",
      keyboard: false,
    });

    let tbody = document.getElementById("tbody");
    tbody.replaceChildren();

    for (const p of products) {
      tbody.appendChild(createTableRow(p));
    }

    addTotalRow(tbody);

    confirmModal.show();
  });

  document.getElementById("confirmBtn").addEventListener("click", function () {
    document.getElementById("orderForm").submit();
  });

  let products = [];

  function find(product) {
    return products.find((p) => p.name === product.name);
  }

  function addProduct(product) {
    let findProduct = find(product);

    if (findProduct) {
      ++findProduct.count;
    } else {
      products.push({
        count: 1,
        image: product.image,
        name: product.name,
        price: product.price,
      });
    }
  }

  function removeProduct(product) {
    let findProduct = find(product);

    if (findProduct) {
      --findProduct.count;
    }
  }

  function addTotalRow(tbody) {
    let tr = createElement("tr", { class: "fw-bold" });
    let title = createElement("td", { colspan: 4, class: "text-center" });
    title.innerText = "Total";
    let price = createElement("td");

    price.innerText =
      products.reduce((c, v) => parseInt(c) + parseInt(v.total), 0).toFixed(2) +
      " MMK";

    tr.appendChild(title);
    tr.appendChild(price);
    tbody.appendChild(tr);
  }

  function createTableRow(p) {
    let tr = createElement("tr");

    for (const [key, value] of Object.entries(p)) {
      let td = createElement("td");
      let ele = null;
      if (key === "image") {
        ele = createElement("img", {
          src: value,
          width: 100,
          class: "img-thumbnail",
        });
      } else {
        ele = document.createTextNode(value);
      }
      td.appendChild(ele);
      tr.appendChild(td);
    }

    return tr;
  }

  function calculateTotalPrice() {
    products = products.map((p) => ({
      ...p,
      total: (p.price * p.count).toFixed(2),
    }));
  }

  function createElement(name, attrs = {}) {
    let ele = document.createElement(name);

    for (const [name, value] of Object.entries(attrs)) {
      ele.setAttribute(name, value);
    }

    return ele;
  }
}
