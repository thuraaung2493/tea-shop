import { Tooltip } from "bootstrap";
import Element from "./element";

export default class Checkout {
  constructor() {
    this.currentUrl = new URL(decodeURIComponent(document.URL));
    this.searchParams = this.currentUrl.searchParams;
  }

  start() {
    this.getElements();

    this.merge();

    this.checkout();
  }

  getElements() {
    this.mergeBtn = Element.findById("mergeBtn");
    this.mergeTableForm = Element.findById("mergeTableForm");
    this.tooltips = Element.get('[data-bs-toggle="tooltip"]');
    this.checkoutBtn = Element.findById("checkout");
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

  merge() {
    this.tooltips.forEach((ele) => {
      this.clickEventListener(ele, () => this.handleMerge(ele));

      return new Tooltip(ele);
    });

    this.clickEventListener(this.mergeBtn, this.handleMergeSubmit);
  }

  checkout() {
    this.clickEventListener(this.checkoutBtn, this.handleCheckout);
  }

  handleMergeSubmit = () => {
    this.mergeTableForm?.submit();
  };

  handleMerge = (ele) => {
    const mergeTables = this.searchParams.getAll("merge_tables[]");
    this.searchParams.delete("merge_tables[]");

    mergeTables
      .filter((t) => t !== ele.dataset.table)
      .forEach((t) => this.searchParams.append("merge_tables[]", t));

    window.location.assign(this.currentUrl);
  };

  handleCheckout = (e) => {
    const url = new URL(e.target.dataset.checkoutUrl);

    this.searchParams.forEach(function (p) {
      url.searchParams.append("merge_tables[]", p);
    });

    fetch(url)
      .then((res) => res.blob())
      .then((blob) => {
        const href = window.URL.createObjectURL(blob);
        const link = Element.create("a", { download: "invoice.pdf", href });
        link.click();
        this.rediect("/");
      })
      .catch((e) => console.error);
  };

  rediect(url) {
    window.location.href = url;
  }
}
