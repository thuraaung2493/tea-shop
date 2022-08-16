export default class Element {
  static get(selector) {
    return document.querySelectorAll(selector);
  }

  static findById(id) {
    return document.getElementById(id);
  }

  static create(name, attrs = {}) {
    let ele = document.createElement(name);

    for (const [name, value] of Object.entries(attrs)) {
      if (Array.isArray(value)) {
        value = value.join(" ");
      }
      ele.setAttribute(name, value);
    }

    return ele;
  }

  static createText(text) {
    return document.createTextNode(text);
  }
}
