import Checkout from "./checkout";
import Element from "./element";
import { showModal } from "./modal";
import OrderForm from "./orderForm";
import State from "./state";

window.addEventListener("DOMContentLoaded", function () {
  new OrderForm(new State()).addEventListeners();

  new Checkout().start();

  Element.findById("image")?.addEventListener("change", function (e) {
    const img = Element.findById("imagePreview");
    img.src = URL.createObjectURL(e.target.files[0]);
  });

  let form = null;
  Element.get(".deleteBtn").forEach(function (ele) {
    ele.addEventListener("click", function (e) {
      e.preventDefault();
      form = Element.findById(`delete-product-${this.dataset.id}`);
      showModal();
    });
  });

  Element.findById("confirm")?.addEventListener("click", function () {
    if (form) {
      form.submit();
    }
  });
});
