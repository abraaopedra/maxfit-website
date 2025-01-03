// main.js
document.addEventListener("DOMContentLoaded", function () {
  // Navigation
  const navLinks = document.querySelectorAll(".nav-link, .card .btn");
  const contentSections = document.querySelectorAll(".content-section");

  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("data-bs-target");

      contentSections.forEach((section) => {
        section.classList.remove("active");
      });

      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        targetSection.classList.add("active");
      }

      navLinks.forEach((navLink) => {
        navLink.classList.remove("active");
      });

      if (this.classList.contains("nav-link")) {
        this.classList.add("active");
      }

      // Scroll to top when changing sections
      window.scrollTo(0, 0);
    });
  });

  // Workout template data
  const workoutTemplates = {
    "Leg Day": ["Squats", "Leg Press", "Lunges", "Calf Raises"],
    "Push Day": [
      "Bench Press",
      "Shoulder Press",
      "Tricep Extensions",
      "Push-ups",
    ],
    "Pull Day": ["Pull-ups", "Rows", "Bicep Curls", "Deadlifts"],
    Cardio: ["Running", "Cycling", "Swimming"],
  };

  function initWorkout() {
    const workoutSection = document.getElementById("workout-templates");
    workoutSection.innerHTML = "";

    for (const [template, exercises] of Object.entries(workoutTemplates)) {
      const templateCard = document.createElement("div");
      templateCard.className = "col-md-4 mb-3";
      templateCard.innerHTML = `
                <div class="card workout-template" data-template="${template}">
                    <div class="card-body">
                        <h5 class="card-title">${template}</h5>
                        <p class="card-text">${exercises.length} exercises</p>
                    </div>
                </div>
            `;
      workoutSection.appendChild(templateCard);
    }

    // Add event listeners to workout templates
    document.querySelectorAll(".workout-template").forEach((template) => {
      template.addEventListener("click", startWorkout);
    });

    // Add event listener to create new template button
    document
      .getElementById("create-template")
      .addEventListener("click", createTemplate);
  }

  // Dashboard initialization
  function initDashboard() {
    // Mock data - replace with real data in production
    const mockData = {
      totalWorkouts: localStorage.getItem("totalWorkouts") || 0,
      activeStreak: localStorage.getItem("activeStreak") || 0,
      lastWorkout: localStorage.getItem("lastWorkout") || "Never",
      recentWorkouts: JSON.parse(localStorage.getItem("recentWorkouts")) || [],
    };

    // Update dashboard stats
    document.getElementById("total-workouts").textContent =
      mockData.totalWorkouts;
    document.getElementById(
      "active-streak"
    ).textContent = `${mockData.activeStreak} days`;
    document.getElementById("last-workout").textContent = mockData.lastWorkout;

    // Update recent workouts list
    const recentWorkoutsList = document.getElementById("recent-workouts-list");
    if (mockData.recentWorkouts.length > 0) {
      recentWorkoutsList.innerHTML = mockData.recentWorkouts
        .map((workout) => `<li class="list-group-item">${workout}</li>`)
        .join("");
    }

    // Add event listeners to quick action buttons
    document.querySelectorAll(".quick-actions button").forEach((button) => {
      button.addEventListener("click", function () {
        const targetSection = this.getAttribute("data-bs-target");
        document.querySelectorAll(".content-section").forEach((section) => {
          section.classList.remove("active");
        });
        document.getElementById(targetSection).classList.add("active");
      });
    });
  }

  // Profile page functionality
  function initProfile() {
    // Load saved profile data
    const savedProfile = JSON.parse(localStorage.getItem("userProfile")) || {};
    const savedMeasurements =
      JSON.parse(localStorage.getItem("bodyMeasurements")) || {};

    // Populate form fields with saved data
    for (const [key, value] of Object.entries(savedProfile)) {
      const element = document.getElementById(key);
      if (element) {
        element.value = value;
      }
    }

    // Populate measurements with saved data
    for (const [key, value] of Object.entries(savedMeasurements)) {
      const element = document.getElementById(key);
      if (element) {
        element.value = value;
      }
    }

    // Handle profile form submission
    document
      .getElementById("profile-form")
      ?.addEventListener("submit", function (e) {
        e.preventDefault();

        const profileData = {
          fullName: document.getElementById("fullName").value,
          email: document.getElementById("email").value,
          age: document.getElementById("age").value,
          weight: document.getElementById("weight").value,
          height: document.getElementById("height").value,
          fitnessGoal: document.getElementById("fitnessGoal").value,
          experience: document.getElementById("experience").value,
          preferredWorkoutTime: document.getElementById("preferredWorkoutTime")
            .value,
        };

        localStorage.setItem("userProfile", JSON.stringify(profileData));

        // Update profile display
        document.getElementById("profile-name").textContent =
          profileData.fullName || "John Doe";

        alert("Profile updated successfully!");
      });

    // Handle measurements save
    document
      .getElementById("save-measurements")
      ?.addEventListener("click", function () {
        const measurementsData = {
          chest: document.getElementById("chest").value,
          waist: document.getElementById("waist").value,
          hips: document.getElementById("hips").value,
          biceps: document.getElementById("biceps").value,
          thighs: document.getElementById("thighs").value,
          calves: document.getElementById("calves").value,
        };

        localStorage.setItem(
          "bodyMeasurements",
          JSON.stringify(measurementsData)
        );
        alert("Measurements saved successfully!");
      });

    // Handle photo change button
    document
      .getElementById("change-photo-btn")
      ?.addEventListener("click", function () {
        alert("Photo upload functionality coming soon!");
      });
  }

  function startWorkout(event) {
    const template = event.currentTarget.dataset.template;
    const exercises = workoutTemplates[template];
    const workoutExercises = document.getElementById("workout-exercises");
    workoutExercises.innerHTML = "";

    exercises.forEach((exercise) => {
      const exerciseItem = document.createElement("div");
      exerciseItem.className = "exercise-item";
      if (template === "Cardio") {
        exerciseItem.innerHTML = `
                    <h4>${exercise}</h4>
                    <div class="mb-2">
                        <input type="number" class="form-control exercise-input" placeholder="Time (min)">
                        <input type="number" class="form-control exercise-input" placeholder="Avg. Speed">
                        <input type="number" class="form-control exercise-input" placeholder="Distance (km)">
                    </div>
                `;
      } else {
        exerciseItem.innerHTML = `
                    <h4>${exercise}</h4>
                    <div class="mb-2">
                        <input type="number" class="form-control exercise-input" placeholder="Weight">
                        <input type="number" class="form-control exercise-input" placeholder="Reps">
                        <input type="number" class="form-control exercise-input" placeholder="Sets">
                    </div>
                `;
      }
      workoutExercises.appendChild(exerciseItem);
    });

    document.getElementById("workout").classList.remove("active");
    document.getElementById("active-workout").classList.add("active");
  }

  // Função para criar template
  function createTemplate() {
    // Abrir o modal ao invés do prompt
    const modal = new bootstrap.Modal(
      document.getElementById("createTemplateModal")
    );
    modal.show();
  }

  // Função para adicionar um novo campo de exercício
  function addExerciseField() {
    const exercisesList = document.getElementById("exercisesList");
    const exerciseCount = exercisesList.children.length + 1;

    const exerciseEntry = document.createElement("div");
    exerciseEntry.className = "exercise-entry mb-3 adding";
    exerciseEntry.innerHTML = `
            <label class="form-label">Exercício ${exerciseCount}</label>
            <div class="input-group">
                <input type="text" class="form-control exercise-input" required>
                <button type="button" class="btn btn-danger remove-exercise">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;

    exercisesList.appendChild(exerciseEntry);

    // Remover a classe de animação após a animação terminar
    setTimeout(() => {
      exerciseEntry.classList.remove("adding");
    }, 300);
  }

  // Função para remover um campo de exercício
  function removeExerciseField(button) {
    const exerciseEntry = button.closest(".exercise-entry");
    exerciseEntry.classList.add("removing");

    setTimeout(() => {
      exerciseEntry.remove();
      updateExerciseLabels();
    }, 300);
  }

  // Função para atualizar as labels dos exercícios
  function updateExerciseLabels() {
    const exercises = document.querySelectorAll(".exercise-entry");
    exercises.forEach((exercise, index) => {
      const label = exercise.querySelector(".form-label");
      label.textContent = `Exercício ${index + 1}`;
    });
  }

  // Função para salvar o template
  function saveNewTemplate() {
    const templateName = document.getElementById("templateName").value.trim();
    const exerciseInputs = document.querySelectorAll(".exercise-input");
    const exercises = Array.from(exerciseInputs).map((input) =>
      input.value.trim()
    );

    if (!templateName) {
      showNotification("Por favor, insira um nome para o template", true);
      return;
    }

    if (exercises.some((exercise) => !exercise)) {
      showNotification("Por favor, preencha todos os exercícios", true);
      return;
    }

    if (workoutTemplates[templateName]) {
      showNotification("Já existe um template com este nome", true);
      return;
    }

    workoutTemplates[templateName] = exercises;
    showNotification("Template criado com sucesso!");

    const modal = bootstrap.Modal.getInstance(
      document.getElementById("createTemplateModal")
    );
    modal.hide();

    initWorkout(); // Atualizar a lista de templates
  }

  // Adicionar os event listeners quando o documento carregar
  document.addEventListener("DOMContentLoaded", function () {
    // ... (código existente) ...

    // Event listener para adicionar exercício
    document
      .getElementById("addExercise")
      .addEventListener("click", addExerciseField);

    // Event listener para remover exercício
    document
      .getElementById("exercisesList")
      .addEventListener("click", function (e) {
        if (e.target.closest(".remove-exercise")) {
          const exercises = document.querySelectorAll(".exercise-entry");
          if (exercises.length > 1) {
            removeExerciseField(e.target.closest(".remove-exercise"));
          }
        }
      });

    // Event listener para salvar template
    document
      .getElementById("saveTemplate")
      .addEventListener("click", saveNewTemplate);

    // Event listener para resetar o modal quando for fechado
    document
      .getElementById("createTemplateModal")
      .addEventListener("hidden.bs.modal", function () {
        const form = document.getElementById("templateForm");
        form.reset();

        const exercisesList = document.getElementById("exercisesList");
        exercisesList.innerHTML = `
                <div class="exercise-entry mb-3">
                    <label class="form-label">Exercício 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control exercise-input" required>
                        <button type="button" class="btn btn-danger remove-exercise" disabled>
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
      });
  });

  document.getElementById("finish-workout").addEventListener("click", () => {
    alert("Workout completed! Data saved.");
    document.getElementById("active-workout").classList.remove("active");
    document.getElementById("workout").classList.add("active");
  });

  function initStats() {
    // Stats functionality will be implemented later
    console.log("Stats initialization");
  }

  // Initialize content
  initWorkout();
  initDashboard();
  initProfile();
  initStats();

  // Theme toggling functionality
  function initTheme() {
    const themeToggle = document.getElementById("theme-toggle");
    const icon = themeToggle.querySelector("i");

    // Check for saved theme preference or default to 'light'
    const savedTheme = localStorage.getItem("theme") || "light";
    document.documentElement.setAttribute("data-theme", savedTheme);

    // Update icon based on current theme
    if (savedTheme === "dark") {
      icon.classList.remove("fa-moon");
      icon.classList.add("fa-sun");
    }

    // Toggle theme
    themeToggle.addEventListener("click", () => {
      const currentTheme = document.documentElement.getAttribute("data-theme");
      const newTheme = currentTheme === "light" ? "dark" : "light";

      document.documentElement.setAttribute("data-theme", newTheme);
      localStorage.setItem("theme", newTheme);

      // Toggle icon
      icon.classList.toggle("fa-moon");
      icon.classList.toggle("fa-sun");
    });
  }

  // Logo navigation
  function initLogoNavigation() {
    const logo = document.querySelector(".navbar-brand");
    logo.addEventListener("click", function (e) {
      e.preventDefault();

      // Remove active class from all sections and nav links
      document.querySelectorAll(".content-section").forEach((section) => {
        section.classList.remove("active");
      });
      document.querySelectorAll(".nav-link").forEach((link) => {
        link.classList.remove("active");
      });

      // Activate home section and home nav link
      document.getElementById("home").classList.add("active");
      document.querySelector('[data-bs-target="home"]').classList.add("active");

      // Scroll to top
      window.scrollTo(0, 0);
    });
  }

  // Login form handler
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const loginButton = document.querySelector("#loginForm button[type='submit']");
      if (loginButton) {
        loginButton.disabled = true;
        loginButton.textContent = "Entrando...";
      }

      try {
        const response = await fetch("login.php", {
          method: "POST",
          body: new FormData(this),
        });
        const data = await response.json();

        if (data.success) {
          showNotification(data.message);
          setTimeout(() => window.location.href = data.redirect, 1500);
        } else {
          showNotification(data.error, true);
        }
      } catch (error) {
        showNotification("Erro ao conectar com o servidor", true);
      } finally {
        if (loginButton) {
          loginButton.disabled = false;
          loginButton.textContent = "Login";
        }
      }
    });
  }

  // Logout link handler
  const logoutLink = document.querySelector("a[href='logout.php']");
  if (logoutLink) {
    logoutLink.addEventListener("click", function (e) {
      e.preventDefault();
      fetch("logout.php")
        .then(() => {
          window.location.href = "index.php";
        })
        .catch((error) => {
          showNotification("Erro ao fazer logout", true);
        });
    });
  }

  // Register form handler
  const registerForm = document.getElementById("registerForm");
  if (registerForm) {
    registerForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      try {
        const response = await fetch("register.php", {
          method: "POST",
          body: new FormData(this),
        });
        const data = await response.json();

        if (data.success) {
          showNotification(data.message);
          $("#registerModal").modal("hide");
          setTimeout(() => $("#loginModal").modal("show"), 1500);
        } else {
          showNotification(data.error, true);
        }
      } catch (error) {
        showNotification("Erro ao conectar com o servidor", true);
      }
    });
  }

  // Update profile form submission
  document
    .getElementById("profile-form")
    ?.addEventListener("submit", async function (e) {
      e.preventDefault();

      const profileData = {
        age: document.getElementById("age").value,
        weight: document.getElementById("weight").value,
        height: document.getElementById("height").value,
        fitnessGoal: document.getElementById("fitnessGoal").value,
        experience: document.getElementById("experience").value,
        preferredWorkoutTime: document.getElementById("preferredWorkoutTime")
          .value,
      };

      try {
        const response = await fetch("api/profile.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(profileData),
        });
        const data = await response.json();
        if (data.success) {
          alert("Profile updated successfully!");
        } else {
          alert("Error updating profile: " + data.error);
        }
      } catch (error) {
        console.error("Error:", error);
      }
    });

  // Função para mostrar notificações
  function showNotification(message, isError = false) {
    Toastify({
      text: message,
      duration: 3000,
      gravity: "top",
      position: "right",
      className: isError ? "error-toast" : "custom-toast",
      stopOnFocus: true,
    }).showToast();
  }

  // Função para criar o modal de exercícios
  function createExerciseModal() {
    const modalHTML = `
            <div class="modal fade" id="exerciseModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content exercise-modal">
                        <div class="modal-header">
                            <h5 class="modal-title">Adicionar Exercício</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="exerciseSearch" placeholder="Buscar exercício...">
                            </div>
                            <div class="exercise-list" id="exerciseList">
                                <!-- Exercícios serão inseridos aqui dinamicamente -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    document.body.insertAdjacentHTML("beforeend", modalHTML);
  }

  // Modificar a função startWorkout
  function startWorkout(event) {
    const template = event.currentTarget.dataset.template;
    const exercises = workoutTemplates[template];
    const workoutExercises = document.getElementById("workout-exercises");
    workoutExercises.innerHTML = "";

    exercises.forEach((exercise) => {
      addExerciseToWorkout(exercise);
    });

    document.getElementById("workout").classList.remove("active");
    document.getElementById("active-workout").classList.add("active");
    showNotification("Treino iniciado com sucesso!");
  }

  // Função para adicionar exercício ao workout
  function addExerciseToWorkout(exercise) {
    const workoutExercises = document.getElementById("workout-exercises");
    const exerciseItem = document.createElement("div");
    exerciseItem.className = "exercise-item";

    if (exercise.includes("Cardio")) {
      exerciseItem.innerHTML = `
                <h4>${exercise}</h4>
                <div class="mb-2">
                    <input type="number" class="form-control exercise-input" placeholder="Tempo (min)">
                    <input type="number" class="form-control exercise-input" placeholder="Velocidade média">
                    <input type="number" class="form-control exercise-input" placeholder="Distância (km)">
                </div>
            `;
    } else {
      exerciseItem.innerHTML = `
                <h4>${exercise}</h4>
                <div class="mb-2">
                    <input type="number" class="form-control exercise-input" placeholder="Peso">
                    <input type="number" class="form-control exercise-input" placeholder="Repetições">
                    <input type="number" class="form-control exercise-input" placeholder="Séries">
                </div>
            `;
    }
    workoutExercises.appendChild(exerciseItem);
  }
  // Initialize theme and logo navigation
  initTheme();
  initLogoNavigation();
});
