
document.addEventListener("DOMContentLoaded", function (event) {
    //forms elements
    let x = document.querySelectorAll("input");
    x.forEach((item) => {
        if(item.hasAttribute("type")) {
            let t = item.getAttribute("type");
            if(t == "checkbox" || t == "radio")
                return;
            if(t == "file") {
                item.addEventListener("change", () => {
                    return;
                    console.log(item.parentElement);
                    console.log(item.value);
                    item.parentElement.setAttribute("data-text", item.value.replace(/.*(\/|\\)/, ''));
                    if (item.value) {
                        item.parentElement.classList.add("has-val");
                        if (item.parentElement.hasAttribute('required')) {
                            item.parentElement.success();
                        }
                    } else {
                        item.parentElement.classList.remove("has-val");
                        if (item.parentElement.hasAttribute('required')) {
                            item.parentElement.displayError("This field is required!");
                        }
                    }
                });
            }
        }
        item.addEventListener("keyup", inputUpdate);
        item.addEventListener("focusout", inputUpdate);
        item.addEventListener("focusin", () => {
            return;
            if (item.classList.contains("input")) {
                //input with icons
                let c = item.parentElement.querySelector(".input-icon")
                c.style.color = "var(--secondary)";
            }
        });
        item.displayError = function(err) {
            return;
            if(item.id) {
                document.getElementById(item.id + "-error").innerHTML = err;
                document.getElementById(item.id + "-error").style.visibility = "visible";
            }
            item.error();
        }
        item.error = function () {
            return;
            item.classList.add("invalid-val");
            item.classList.remove("valid-val");
            if (this.classList.contains("input")) {
                let c = this.parentElement.querySelector(".input-icon")
                c.style.color = "var(--danger)";
            }
        }
        item.success = function () {
            return;
            item.displayError("<br>");
            item.classList.add("valid-val");
            item.classList.remove("invalid-val");
            if (this.classList.contains("input")) {
                let c = this.parentElement.querySelector(".input-icon")
                c.style.color = "var(--success)";
            }
        }
        if(item.id) {
            item.insertAdjacentHTML('afterend', '<div id="'+item.id+'-error" class="input-error"><br></div>')
        }
    });
    x = document.querySelectorAll("select");
    x.forEach((item) => {
        item.addEventListener("change", selectUpdate);
        item.addEventListener("focusout", selectUpdate);
        
        item.displayError = function (err) {
            if (item.id) {
                document.getElementById(item.id + "-error").innerHTML = err;
                document.getElementById(item.id + "-error").style.visibility = "visible";
            }
            item.error();
        }
        item.error = function () {
            item.classList.add("invalid-val");
            item.classList.remove("valid-val");
        }
        item.success = function () {
            item.displayError("<br>");
            item.classList.add("valid-val");
            item.classList.remove("invalid-val");
        }
        if (item.id) {
            item.insertAdjacentHTML('afterend', '<div id="' + item.id + '-error" class="input-error"><br></div>')
        }
    });

    //navbar
    window.addEventListener("resize", navbarResize);
    navbarResize();
});


function inputUpdate(e) {
    if (this.value) {
        this.classList.add("has-val");
        if (this.classList.contains("input")) {
            //input with icons
            let c = this.parentElement.querySelector(".input-icon")
            c.style.color = "var(--secondary)";
        }
        if (this.hasAttribute('required') && e.type == "focusout") {
            this.success();
        }
    } else {
        this.classList.remove("has-val");
        if (this.classList.contains("input") && e.type == "focusout") {
            //input with icons
            let c = this.parentElement.querySelector(".input-icon")
            c.style.color = "#d9d9d9";
        }
        if (this.hasAttribute('required') && e.type == "focusout") {
            this.displayError("This field is required!");
        }
    }

}

function selectUpdate() {
    if (this.options[this.selectedIndex].value === '') {
        this.classList.remove("has-val");
        if (this.hasAttribute('required')) {
            this.displayError("This field is required!");

        }
    } else {
        this.classList.add("has-val");
        if (this.hasAttribute('required')) {
            this.success();
        }
    }
}

var totalWidth;
function navbarResize() {
    let n = document.querySelector(".layout-navbar");
    if(!totalWidth) {
        totalWidth = n.querySelector(".navbar-title").offsetWidth + n.querySelector(".navbar-items").offsetWidth;
        totalWidth += 200; //another 200px
        n.querySelector(".navbar-mobile").addEventListener("click", navbarToggle)
    } else {
        //should recalculate?
        if (n.querySelector(".navbar-title").offsetWidth + n.querySelector(".navbar-items").offsetWidth + 200 > totalWidth) {
            totalWidth = n.querySelector(".navbar-title").offsetWidth + n.querySelector(".navbar-items").offsetWidth + 200;
            return;
        }
    }
    if(totalWidth > window.innerWidth) {
        //menu must be closed
        n.querySelector(".navbar-items").style.display = "none";
        n.querySelector(".navbar-items").classList.add("navbar-items-mobile");
        n.querySelector(".navbar-mobile").style.display = "block";
        let c = n.querySelectorAll(".navbar-items > .navbar-item");
        console.log(c);
        c.forEach((item) => {
            item.classList.add("navbar-item-mobile");
        })

    } else {
        n.querySelector(".navbar-items").style.display = "block";

        n.querySelector(".navbar-items").classList.remove("navbar-items-mobile");
        n.querySelector(".navbar-mobile").style.display = "none";
        let c = n.querySelectorAll(".navbar-items > .navbar-item");
        c.forEach((item) => {
            item.classList.remove("navbar-item-mobile");
        })
    }
}

function navbarToggle() {
    let n = document.querySelector(".layout-navbar");
    let o = n.querySelector(".navbar-items").style.display == "block";
    document.querySelector("body").style.overflow = (o ? "auto" : "hidden");
    if(!o) {
        n.querySelector(".navbar-items").style.display = "block";
    }
    setTimeout(() => {
        n.querySelector(".navbar-items-mobile").style.maxHeight = (o ? "0px" : "calc(100vh - 64px)");
        
    }, 10);
    if(o) {
        setTimeout(() => {
            n.querySelector(".navbar-items").style.display = "none";
        }, 300);
    }
}