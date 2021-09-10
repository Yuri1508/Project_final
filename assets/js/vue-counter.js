const vue_counter = document.getElementById("vue_counter");

const incrementCounter = async () => {
    const data = await fetch('https://api.countapi.xyz/hit/natura_vue/SolarCounterUpVue')
    const vue = await data.json()
    vue_counter.innerHTML = vue.value
    vue_counter.style.filter = 'blur(0)'
};

incrementCounter();