class Greeter
{
    greeting: string;
    constructor(message: string)
    {
        this.greeting = message;
    }
    greet()
    {
        return "Hello, "+this.greeting;
    }
}
let greeter = new Greeter("world");

let button = document.createElement("button");
button.textContent = "say hello";
button.onclick = function()
{
    alert(greeter.greet());
}

document.body.append(button);
