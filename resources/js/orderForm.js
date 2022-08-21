import Element from "./element";
import { showModal } from "./modal";

export default class OrderForm {
  constructor(state) {
    this.state = state;

    this.getElements();
  }

  getElements() {
    this.incrementBtns = Element.get(".incrementBtn");
    this.decrementBtns = Element.get(".decrementBtn");
    this.orderBtn = Element.findById("orderBtn");
    this.confirmBtn = Element.findById("confirmBtn");
    this.orderForm = Element.findById("orderForm");
  }

  addEventListeners() {
    this.clickEventListener(this.incrementBtns, this.handleIncrement);
    this.clickEventListener(this.decrementBtns, this.handleDecrement);

    this.clickEventListener(this.orderBtn, this.handleOrder);
    this.clickEventListener(this.confirmBtn, this.handleFormSubmit);
  }

  clickEventListener(elements, handleClick) {
    if (elements instanceof NodeList) {
      elements.forEach((ele) => {
        ele.addEventListener("click", handleClick);
      });
    } else {
      elements?.addEventListener("click", handleClick);
    }
  }

  handleIncrement = (e) => {
    let parent = e.target.parentElement;
    let input = parent.querySelector("input[type='text']");
    let value = +input.getAttribute("value");
    input.setAttribute("value", value + 1);
    let product = JSON.parse(parent.dataset.product);

    this.state.addProduct(product);
  };

  handleDecrement = (e) => {
    let parent = e.target.parentElement;
    let input = parent.querySelector("input[type='text']");
    let value = +input.getAttribute("value");
    if (value > 0) {
      input.setAttribute("value", value - 1);
    }
    let product = JSON.parse(parent.dataset.product);
    this.state.removeProduct(product);
  };

  handleOrder = () => {
    this.state.calculateTotalPrice();

    // this.createTable();
    let tbody = Element.findById("tbody");
    tbody.replaceChildren();

    for (const p of this.state.products) {
      tbody.appendChild(this.createTableRow(p));
    }

    this.addTotalRow(tbody);

    showModal();
  };

  handleFormSubmit = () => {
    if (this.state.products.length > 0) this.orderForm.submit();
  };

  createTableRow(p) {
    let tr = Element.create("tr");

    for (const [key, value] of Object.entries(p)) {
      let td = Element.create("td");
      let ele = null;
      if (key === "image") {
        ele = Element.create("img", {
          src: value.url,
          width: 100,
          class: "img-thumbnail",
        });
      } else {
        ele = Element.createText(value);
      }
      td.appendChild(ele);
      tr.appendChild(td);
    }

    return tr;
  }

  addTotalRow(tbody) {
    let tr = Element.create("tr", { class: "fw-bold" });
    let title = Element.create("td", { colspan: 4, class: "text-center" });
    title.innerText = "Total";
    let price = Element.create("td");

    price.innerText =
      this.state.products
        .reduce((c, v) => parseInt(c) + parseInt(v.total), 0)
        .toFixed(2) + " MMK";

    tr.appendChild(title);
    tr.appendChild(price);
    tbody.appendChild(tr);
  }
}
