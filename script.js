function submit(fName, idArray) {
  var inData = "";
  for (var id of idArray) {
    var input = document.getElementById(id).value;
    if (input) {
      inData += id + ": \n\n\t" + input + "\n\n\n";
      sessionStorage.setItem(id, input);
    } else {
      inData += id + ": \n\n\t" + "N/A" + "\n\n\n";
    }
  }

  var data2Blob = new File([inData], fName, { type: "text/plain" });
  var blob2URL = window.URL.createObjectURL(data2Blob);
  var anchorTag = document.createElement("a");
  anchorTag.href = blob2URL;
  anchorTag.download = fName;
  anchorTag.click();
}

function submitIndex() {
  submit("Home.txt", ["professional-statement", "brief-biography"]);
}
function submitResume() {
  submit("Resume.txt", [
    "educational-qualifications",
    "skill-set",
    "awards-recognition",
    "work-experience",
    "referees",
  ]);
}
function submitProjects() {
  submit("Projects", ["my-projects"]);
}
function submitSocial() {
  submit("Social.txt", ["social-link-1", "social-link-2", "social-link-3"]);
}

function readMessages() {
  var fileInput = document.createElement("input");
  fileInput.type = "file";

  fileInput.onchange = function () {
    var file = fileInput.files[0];
    var filereader = new FileReader();

    filereader.onload = function (FileLoadedEvent) {
      var TextResult = FileLoadedEvent.target.result;
      var div = document.getElementById("displayText");
      div.innerText = TextResult;
      sessionStorage.setItem("displayText", TextResult);
    };

    filereader.readAsText(file, "UTF-8");
  };

  fileInput.click();
}

function processLogout() {
  sessionStorage.clear();
  window.location.href = "adminIndex.html";
}

window.onload = function () {
  var textareas = document.getElementsByTagName("textarea");
  for (var textarea of textareas) {
    var textareaId = textarea.id;
    var savedText = sessionStorage.getItem(textareaId);
    if (savedText !== null) {
        textarea.value = savedText;
    }
  }

  var savedContents = sessionStorage.getItem("displayText");
  if (savedContents !== null) {
    var div = document.getElementById("displayText");
    div.innerText = savedContents;
  }
};
