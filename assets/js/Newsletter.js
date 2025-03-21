document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("newsletter-form");
    const feedback = document.getElementById("feedback-message");
  
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
  
      const formData = new FormData(form);
      const response = await fetch("/newsletter", {
        method: "POST",
        body: formData
      });
  
      const result = await response.json();
      
      feedback.textContent = result.message;
      feedback.style.color = result.status === "success" ? "green" : "red";
      form.reset();
    });
  });