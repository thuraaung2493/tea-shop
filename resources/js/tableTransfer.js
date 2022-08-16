import Element from "./element";
import { showModal } from "./modal";

window.addEventListener("DOMContentLoaded", ready);

function ready() {
  Element.get(".transferBtn").forEach(function (ele) {
    ele.addEventListener("click", function (e) {
      let from = Element.get("input[name='from']")[0];
      from.value = this.dataset.tableNo;
      showModal("tableTransferModal");
    });
  });

  Element.findById("transferBtn")?.addEventListener("click", function () {
    Element.findById("tableTransferForm").submit();
  });
}
