import { Modal } from "bootstrap";
import Element from "./element";

export const showModal = (modalId = "confirmModal") => {
  let modal = new Modal(Element.findById(modalId), {
    backdrop: "static",
    keyboard: false,
  });

  modal.show();
};
