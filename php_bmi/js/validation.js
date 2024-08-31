document.getElementById("registrationForm").onsubmit = function() {
    var username = document.getElementById("username").value.trim();
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();

    if (username == "" || email == "" || password == "") {
        alert("All fields are required.");
        return false;
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (password.length < 8) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    return true;
};
