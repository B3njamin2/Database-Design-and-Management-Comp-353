document.addEventListener("DOMContentLoaded", function () {
  // Get the textarea elements
  var textarea1 = document.getElementById("query");
  var textarea2 = document.getElementById("query_input");

  // Load the saved values from local storage, if any
  if (localStorage.getItem("savedText1")) {
    textarea1.value = localStorage.getItem("savedText1");
  }
  if (localStorage.getItem("savedText2")) {
    textarea2.value = localStorage.getItem("savedText2");
  }



  var toggleButton = document.getElementById("toggle-Button");

  var clearEnabled = false;

  // Add click event listener to the toggle button
  toggleButton.addEventListener("click", function () {
    clearEnabled = !clearEnabled; // Toggle the flag
    if (clearEnabled) {
      toggleButton.textContent = "On"; // Change the text content of the button
      toggleButton.disabled = false; // Enable the clear button
    } else {
      toggleButton.textContent = "Off"; // Change the text content of the button
      toggleButton.disabled = true; // Disable the clear button
    }
  });

  // Save the values to local storage whenever they change
  textarea1.addEventListener("input", function () {
    localStorage.setItem("savedText1", textarea1.value);
  });
  textarea2.addEventListener("input", function () {
    localStorage.setItem("savedText2", textarea2.value);
  });

  clearButton1.addEventListener("click", function () {
    if (clearEnabled) {
      textarea1.value = "";
      localStorage.removeItem("savedText1");
    }
  });

  clearButton2.addEventListener("click", function () {
    if (clearEnabled) {
      textarea2.value = "";
      localStorage.removeItem("savedText2");
    }
  });
});
