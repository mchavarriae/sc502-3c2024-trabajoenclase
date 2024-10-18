//datos complejos (objetos, arreglos)
const person = { name: "Alice", age: 30 };
person.age = 31; // Esto es permitido
person.name = "Roberto" //esto es permitido
console.log(person.age); // 31

const numbers = [1, 2, 3];
numbers.push(4); // Esto es permitido
console.log(numbers); // [1, 2, 3, 4]

//datos primitivos:
//number, date, boolean, string
const x = 10;
x = 20; // Error: Assignment to constant variable.

let arr = [1,1,2,3,5,8]
for (let index = 0; index < array.length; index++) {
    const element = array[index];
}

for (let x in arr){
    console.log(x);
}