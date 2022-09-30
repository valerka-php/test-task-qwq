class Product {
    async getCategories() {
        let response = await fetch('/api/category');
        return await response.json();
    }
}

let obj = new Product();
let categories = obj.getCategories();

console.log(categories);

