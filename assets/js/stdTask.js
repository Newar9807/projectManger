$(document).ready(function () {
  const planningTableArea = document.getElementById("table-area");
  const planningToggleBtn = document.getElementById("planning");
  const planningPhaseHeader = document.querySelector(
    ".phase-header.notification"
  );

  $(".sectionContent").on("click", "#table-area", function () {
    if (planningTableArea.style.display === "none") {
      planningTableArea.style.display = "block";
      planningToggleBtn.innerText = "-";
      planningPhaseHeader.classList.remove("notification");
    } else {
      planningTableArea.style.display = "none";
      planningToggleBtn.innerText = "+";
    }
  });

  const analysisTableArea = document.getElementById("table-area2");
  const analysisToggleBtn = document.getElementById("analysis");
  const analysisPhaseHeader = document.querySelectorAll(
    ".phase-header.notification"
  )[1];

  $(".sectionContent").on("click", ".expandTask", function () {
    if (analysisTableArea.style.display === "none") {
      analysisTableArea.style.display = "block";
      analysisToggleBtn.innerText = "-";
      analysisPhaseHeader.classList.remove("notification");
    } else {
      analysisTableArea.style.display = "none";
      analysisToggleBtn.innerText = "+";
    }
  });
  // analysisToggleBtn.addEventListener("click", () => {});

  const designTableArea = document.getElementById("table-area3");
  const designToggleBtn = document.getElementById("design");
  const designPhaseHeader = document.querySelectorAll(
    ".phase-header.notification"
  )[2];
  designToggleBtn.addEventListener("click", () => {
    if (designTableArea.style.display === "none") {
      designTableArea.style.display = "block";
      designToggleBtn.innerText = "-";
      designPhaseHeader.classList.remove("notification");
    } else {
      designTableArea.style.display = "none";
      designToggleBtn.innerText = "+";
    }
  });

  const developmentTableArea = document.getElementById("table-area4");
  const developmentToggleBtn = document.getElementById("development");
  const developmentPhaseHeader = document.querySelectorAll(
    ".phase-header.notification"
  )[3];
  developmentToggleBtn.addEventListener("click", () => {
    if (developmentTableArea.style.display === "none") {
      developmentTableArea.style.display = "block";
      developmentToggleBtn.innerText = "-";
      developmentPhaseHeader.classList.remove("notification");
    } else {
      developmentTableArea.style.display = "none";
      developmentToggleBtn.innerText = "+";
    }
  });

  const testingTableArea = document.getElementById("table-area5");
  const testingToggleBtn = document.getElementById("testing");
  const testingPhaseHeader = document.querySelectorAll(
    ".phase-header.notification"
  )[4];
  testingToggleBtn.addEventListener("click", () => {
    if (testingTableArea.style.display === "none") {
      testingTableArea.style.display = "block";
      testingToggleBtn.innerText = "-";
      testingPhaseHeader.classList.remove("notification");
    } else {
      testingTableArea.style.display = "none";
      testingToggleBtn.innerText = "+";
    }
  });

  const integrationTableArea = document.getElementById("table-area6");
  const integrationToggleBtn = document.getElementById("integration");
  const integrationPhaseHeader = document.querySelectorAll(
    ".phase-header.notification"
  )[5];
  integrationToggleBtn.addEventListener("click", () => {
    if (integrationTableArea.style.display === "none") {
      integrationTableArea.style.display = "block";
      integrationToggleBtn.innerText = "-";
      integrationPhaseHeader.classList.remove("notification");
    } else {
      integrationTableArea.style.display = "none";
      integrationToggleBtn.innerText = "+";
    }
  });

  const maintainanceTableArea = document.getElementById("table-area7");
  const maintainanceToggleBtn = document.getElementById("maintainance");
  const maintainancePhaseHeader = document.querySelectorAll(
    ".phase-header.notification"
  )[6];
  maintainanceToggleBtn.addEventListener("click", () => {
    if (maintainanceTableArea.style.display === "none") {
      maintainanceTableArea.style.display = "block";
      maintainanceToggleBtn.innerText = "-";
      maintainancePhaseHeader.classList.remove("notification");
    } else {
      maintainanceTableArea.style.display = "none";
      maintainanceToggleBtn.innerText = "+";
    }
  });
});
