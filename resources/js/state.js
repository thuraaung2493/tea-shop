export default class State {
  constructor(products = []) {
    this.products = products;
  }

  calculateTotalPrice() {
    this.products = this.products.map((p) => ({
      ...p,
      total: (p.price * p.count).toFixed(2),
    }));
  }

  find(product) {
    return this.products.find((p) => p.name === product.name);
  }

  addProduct(product) {
    let findProduct = this.find(product);

    if (findProduct) {
      ++findProduct.count;
    } else {
      this.products.push({
        count: 1,
        image: product.image,
        name: product.name,
        price: product.price.value,
      });
    }
  }

  removeProduct(product) {
    let findProduct = this.find(product);

    if (findProduct) {
      --findProduct.count;
    }
  }
}
