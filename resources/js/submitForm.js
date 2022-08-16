import Element from "./element";
import { showModal } from "./modal";

window.addEventListener("DOMContentLoaded", ready);

function ready() {
  Element.findById("submit")?.addEventListener("click", () => showModal());

  Element.findById("confirm")?.addEventListener("click", () =>
    Element.findById("form")?.submit()
  );
}
