import { Tooltip } from "bootstrap";
import Element from "./element";
import OrderForm from "./orderForm";
import State from "./state";

window.addEventListener("DOMContentLoaded", function () {
  new OrderForm(new State()).addEventListeners();

  Element.findById("mergeBtn")?.addEventListener("click", function (e) {
    Element.findById("mergeTableForm")?.submit();
  });

  Element.get('[data-bs-toggle="tooltip"]').forEach(function (ele) {
    const url = new URL(decodeURIComponent(document.URL));
    const mergeTables = url.searchParams.getAll("merge_tables[]");

    ele.addEventListener("click", function (e) {
      url.searchParams.delete("merge_tables[]");

      mergeTables
        .filter((t) => t !== ele.dataset.table)
        .forEach((t) => url.searchParams.append("merge_tables[]", t));

      window.location.assign(url);
    });

    return new Tooltip(ele);
  });
});
