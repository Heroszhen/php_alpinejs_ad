class DataTable {
    constructor(id, number) {
        this.table = document.getElementById(id);
        this.body = this.table.querySelector("tbody");
        this.number = number;
        this.select = document.createElement("select");
        this.index = 0;
        this.totalTrs = 0;
        this.run();
    }

    run() {
        this.totalTrs = this.selectData(this.index);
        let div = document.createElement("div");
        div.className = "data-table-wrap-select";
        div.appendChild(this.select);
        this.table.after(div);
    }

    createOptions() {
        this.select.innerHTML = "";
        let rest = this.totalTrs % this.number;
        let totalOptions = 0;
        totalOptions = (this.totalTrs - rest) / this.number;
        if (rest !== 0) totalOptions++;
        for (let i = 0; i < totalOptions; i++) {
            let option = document.createElement("option");
            option.textContent = i + 1;
            option.value = i;
            if (this.index === i) option.selected = 'selected';
            this.select.appendChild(option);
        }
        this.select.addEventListener("change", (e) => {
            this.index = parseInt(e.target.value);
            this.selectData();
        })
    }

    selectData() {
        let max = (this.index + 1) * this.number;
        let min = max - this.number + 1;
        let children = this.body.childNodes;
        let index = 0;
        for (let entry of children) {
            if (entry.nodeName.toLowerCase() === "tr") {
                index++;
                if (min <= index && index <= max) {
                    entry.style.display = "table-row";
                } else {
                    entry.style.display = "none";
                }
            }
        }

        return index;
    }

    setTotal(n) {
        this.totalTrs += n;
        this.createOptions();
        this.selectData();
    }
}