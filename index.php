<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FitTrack Pro</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/main.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <!-- Toastify CSS -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"
    />
    <!-- Toastify JS -->
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/toastify-js"
    ></script>
  </head>
  <body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" data-bs-target="home">
          <i class="fas fa-dumbbell me-2"></i>FitTrack Pro
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#" data-bs-target="home">
                <i class="fas fa-home me-1"></i>Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-target="workout">
                <i class="fas fa-running me-1"></i>Workout
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-target="profile">
                <i class="fas fa-user me-1"></i>Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-target="stats">
                <i class="fas fa-chart-line me-1"></i>Statistics
              </a>
            </li>
            <li class="nav-item">
              <button class="theme-toggle" id="theme-toggle">
                <i class="fas fa-moon"></i>
              </button>
            </li>
            <?php if ($isLoggedIn): ?>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <i class="fas fa-sign-out-alt me-1"></i>Logout
                </a>
              </li>
            <?php else: ?>
              <li class="nav-item" id="loginNav">
                <a
                  class="nav-link"
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#loginModal"
                >
                  <i class="fas fa-sign-in-alt me-1"></i>Login
                </a>
              </li>
              <li class="nav-item" id="registerNav">
                <a
                  class="nav-link"
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#registerModal"
                >
                  <i class="fas fa-user-plus me-1"></i>Register
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-4">
      <!-- Home Section -->
      <div id="home" class="content-section active">
        <div class="container py-4">
          <!-- Welcome Section -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card bg-primary text-white">
                <div class="card-body">
                  <h2 class="card-title">Welcome to FitTrack Pro!</h2>
                  <p class="card-text">
                    Track your fitness journey and achieve your goals.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Stats -->
          <div class="row mb-4">
            <div class="col-md-4 mb-3">
              <div class="card h-100">
                <div class="card-body text-center">
                  <i
                    class="fas fa-dumbbell mb-3"
                    style="font-size: 2rem; color: #007bff"
                  ></i>
                  <h5 class="card-title">Total Workouts</h5>
                  <h3 class="card-text" id="total-workouts">0</h3>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card h-100">
                <div class="card-body text-center">
                  <i
                    class="fas fa-fire mb-3"
                    style="font-size: 2rem; color: #dc3545"
                  ></i>
                  <h5 class="card-title">Active Streak</h5>
                  <h3 class="card-text" id="active-streak">0 days</h3>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card h-100">
                <div class="card-body text-center">
                  <i
                    class="fas fa-clock mb-3"
                    style="font-size: 2rem; color: #28a745"
                  ></i>
                  <h5 class="card-title">Last Workout</h5>
                  <h3 class="card-text" id="last-workout">Never</h3>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Activity -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="card h-100">
                <div class="card-header">
                  <h5 class="card-title mb-0">Recent Workouts</h5>
                </div>
                <div class="card-body">
                  <ul
                    class="list-group list-group-flush"
                    id="recent-workouts-list"
                  >
                    <li class="list-group-item text-muted">
                      No recent workouts
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card h-100">
                <div class="card-header">
                  <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                  <div class="d-grid gap-2">
                    <button class="btn btn-primary" data-bs-target="workout">
                      Start New Workout
                    </button>
                    <button
                      class="btn btn-outline-primary"
                      data-bs-target="profile"
                    >
                      Update Profile
                    </button>
                    <button
                      class="btn btn-outline-primary"
                      data-bs-target="stats"
                    >
                      View Statistics
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Workout Section -->
      <div id="workout" class="content-section">
        <h2 class="mb-4">Workout Templates</h2>
        <div class="row" id="workout-templates">
          <!-- Workout templates will be dynamically added here -->
        </div>
        <button class="btn btn-primary mt-3" id="create-template">
          Create New Template
        </button>
      </div>

      <!-- Active Workout Section -->
      <div id="active-workout" class="content-section">
        <h2 class="mb-4">Current Workout</h2>
        <div id="workout-exercises">
          <!-- Active workout exercises will be dynamically added here -->
        </div>
        <button class="btn btn-primary mt-3" id="finish-workout">
          Finish Workout
        </button>
      </div>

      <!-- Profile Section -->
      <div id="profile" class="content-section">
        <div class="container py-4">
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="card">
                <div class="card-body text-center">
                  <div class="profile-picture-container mb-3">
                    <div class="profile-picture">
                      <i class="fas fa-user-circle"></i>
                    </div>
                    <button
                      class="btn btn-sm btn-primary mt-2"
                      id="change-photo-btn"
                    >
                      <i class="fas fa-camera me-1"></i>Change Photo
                    </button>
                  </div>
                  <h3 id="profile-name">John Doe</h3>
                  <p class="text-muted" id="member-since">
                    Member since: Jan 2024
                  </p>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Personal Information</h4>
                  <form id="profile-form">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="fullName" class="form-label"
                          >Full Name</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="fullName"
                          placeholder="Enter your full name"
                        />
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          placeholder="Enter your email"
                        />
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input
                          type="number"
                          class="form-control"
                          id="age"
                          placeholder="Age"
                        />
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="weight" class="form-label"
                          >Weight (kg)</label
                        >
                        <input
                          type="number"
                          class="form-control"
                          id="weight"
                          step="0.1"
                          placeholder="Weight"
                        />
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="height" class="form-label"
                          >Height (cm)</label
                        >
                        <input
                          type="number"
                          class="form-control"
                          id="height"
                          placeholder="Height"
                        />
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 mb-3">
                        <label for="fitnessGoal" class="form-label"
                          >Fitness Goal</label
                        >
                        <select class="form-select" id="fitnessGoal">
                          <option value="">Select your goal</option>
                          <option value="weight-loss">Weight Loss</option>
                          <option value="muscle-gain">Muscle Gain</option>
                          <option value="maintenance">Maintenance</option>
                          <option value="endurance">Endurance</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="experience" class="form-label"
                          >Experience Level</label
                        >
                        <select class="form-select" id="experience">
                          <option value="">Select experience level</option>
                          <option value="beginner">Beginner</option>
                          <option value="intermediate">Intermediate</option>
                          <option value="advanced">Advanced</option>
                        </select>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="preferredWorkoutTime" class="form-label"
                          >Preferred Workout Time</label
                        >
                        <select class="form-select" id="preferredWorkoutTime">
                          <option value="">Select preferred time</option>
                          <option value="morning">Morning</option>
                          <option value="afternoon">Afternoon</option>
                          <option value="evening">Evening</option>
                        </select>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                          Save Changes
                        </button>
                        <button
                          type="reset"
                          class="btn btn-outline-secondary ms-2"
                        >
                          Reset
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="card mt-4">
                <div class="card-body">
                  <h4 class="card-title mb-4">Body Measurements</h4>
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label for="chest" class="form-label">Chest (cm)</label>
                      <input
                        type="number"
                        class="form-control"
                        id="chest"
                        placeholder="Chest"
                      />
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="waist" class="form-label">Waist (cm)</label>
                      <input
                        type="number"
                        class="form-control"
                        id="waist"
                        placeholder="Waist"
                      />
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="hips" class="form-label">Hips (cm)</label>
                      <input
                        type="number"
                        class="form-control"
                        id="hips"
                        placeholder="Hips"
                      />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label for="biceps" class="form-label">Biceps (cm)</label>
                      <input
                        type="number"
                        class="form-control"
                        id="biceps"
                        placeholder="Biceps"
                      />
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="thighs" class="form-label">Thighs (cm)</label>
                      <input
                        type="number"
                        class="form-control"
                        id="thighs"
                        placeholder="Thighs"
                      />
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="calves" class="form-label">Calves (cm)</label>
                      <input
                        type="number"
                        class="form-control"
                        id="calves"
                        placeholder="Calves"
                      />
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-12">
                      <button
                        type="button"
                        class="btn btn-primary"
                        id="save-measurements"
                      >
                        Save Measurements
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Stats Section -->
      <div id="stats" class="content-section">
        <div class="container py-4">
          <h2 class="mb-4">Your Statistics</h2>
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Workout Progress</h5>
                </div>
                <div class="card-body">
                  <p class="text-muted">
                    Workout progress visualization coming soon!
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Weight Progress</h5>
                </div>
                <div class="card-body">
                  <p class="text-muted">
                    Weight tracking visualization coming soon!
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Workout History</h5>
                </div>
                <div class="card-body">
                  <p class="text-muted">
                    Detailed workout history coming soon!
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Login Modal -->
    <div
      class="modal fade"
      id="loginModal"
      tabindex="-1"
      aria-labelledby="loginModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form id="loginForm" method="POST" action="login.php">
              <div class="mb-3">
                <label for="loginEmail" class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="loginEmail"
                  name="email"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="loginPassword"
                  name="password"
                  required
                />
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
              <p class="text-center mt-3 mb-0">
                Don't have an account?
                <a
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#registerModal"
                  data-bs-dismiss="modal"
                >
                  Register here
                </a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Register Modal -->
    <div
      class="modal fade"
      id="registerModal"
      tabindex="-1"
      aria-labelledby="registerModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Create Account</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form id="registerForm" method="POST" action="register.php">
              <div class="mb-3">
                <label for="registerUsername" class="form-label"
                  >Username</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="registerUsername"
                  name="username"
                  placeholder="Username"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="registerEmail" class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="registerEmail"
                  name="email"
                  placeholder="Email"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="registerPassword" class="form-label"
                  >Password</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="registerPassword"
                  name="password"
                  placeholder="Password"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="registerFullName" class="form-label"
                  >Full Name</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="registerFullName"
                  name="fullName"
                  placeholder="Full Name"
                  required
                />
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                  Create Account
                </button>
              </div>
              <p class="text-center mt-3 mb-0">
                Already have an account?
                <a
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#loginModal"
                  data-bs-dismiss="modal"
                >
                  Login here
                </a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de Criação de Template -->
    <div class="modal fade" id="createTemplateModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Criar Novo Template</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <form id="templateForm">
              <div class="mb-3">
                <label for="templateName" class="form-label"
                  >Nome do Template</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="templateName"
                  required
                />
              </div>
              <div id="exercisesList">
                <div class="exercise-entry mb-3">
                  <label class="form-label">Exercício 1</label>
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control exercise-input"
                      required
                    />
                    <button
                      type="button"
                      class="btn btn-danger remove-exercise"
                      disabled
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-secondary" id="addExercise">
                <i class="fas fa-plus"></i> Adicionar Exercício
              </button>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Cancelar
            </button>
            <button type="button" class="btn btn-primary" id="saveTemplate">
              Salvar Template
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
      <p class="mb-0">&copy; 2024 FitTrack Pro. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="js/main.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Navigation
        const navLinks = document.querySelectorAll(".nav-link, .card .btn");
        const contentSections = document.querySelectorAll(".content-section");

        navLinks.forEach((link) => {
          link.addEventListener("click", function (event) {
            event.preventDefault();
            const target = document.querySelector(this.getAttribute("data-bs-target"));
            if (target) {
              contentSections.forEach((section) => section.classList.add("d-none"));
              target.classList.remove("d-none");
            }
          });
        });

        // Handle login form submission
        const loginForm = document.getElementById("loginForm");
        if (loginForm) {
          loginForm.addEventListener("submit", async function (e) {
            e.preventDefault();

            const loginButton = document.querySelector("#loginButton");
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
                showNotification("Login successful!");
                window.location.reload();
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
          if (workoutSection) {
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
            const createTemplateButton = document.getElementById("create-template");
            if (createTemplateButton) {
              createTemplateButton.addEventListener("click", createTemplate);
            }
          }
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
          const totalWorkoutsElement = document.getElementById("total-workouts");
          if (totalWorkoutsElement) {
            totalWorkoutsElement.textContent = mockData.totalWorkouts;
          }
          const activeStreakElement = document.getElementById("active-streak");
          if (activeStreakElement) {
            activeStreakElement.textContent = `${mockData.activeStreak} days`;
          }
          const lastWorkoutElement = document.getElementById("last-workout");
          if (lastWorkoutElement) {
            lastWorkoutElement.textContent = mockData.lastWorkout;
          }

          // Update recent workouts list
          const recentWorkoutsList = document.getElementById("recent-workouts");
          if (recentWorkoutsList) {
            recentWorkoutsList.innerHTML = "";
            mockData.recentWorkouts.forEach((workout) => {
              const listItem = document.createElement("li");
              listItem.textContent = workout;
              recentWorkoutsList.appendChild(listItem);
            });
          }
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
          const profileForm = document.getElementById("profile-form");
          if (profileForm) {
            profileForm.addEventListener("submit", function (e) {
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
              const profileNameElement = document.getElementById("profile-name");
              if (profileNameElement) {
                profileNameElement.textContent = profileData.fullName || "John Doe";
              }

              alert("Profile updated successfully!");
            });
          }

          // Handle measurements save
          const saveMeasurementsButton = document.getElementById("save-measurements");
          if (saveMeasurementsButton) {
            saveMeasurementsButton.addEventListener("click", function () {
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
          }

          // Handle photo change button
          const changePhotoButton = document.getElementById("change-photo-btn");
          if (changePhotoButton) {
            changePhotoButton.addEventListener("click", function () {
              alert("Photo upload functionality coming soon!");
            });
          }
        }

        function startWorkout(event) {
          const template = event.currentTarget.dataset.template;
          const exercises = workoutTemplates[template];
          const workoutExercises = document.getElementById("workout-exercises");
          if (!workoutExercises) return;
          workoutExercises.innerHTML = "";

          exercises.forEach((exercise) => {
            const exerciseItem = document.createElement("div");
            exerciseItem.className = "exercise-item";
            exerciseItem.textContent = exercise;
            workoutExercises.appendChild(exerciseItem);
          });

          const workoutSection = document.getElementById("workout");
          const activeWorkoutSection = document.getElementById("active-workout");
          if (workoutSection && activeWorkoutSection) {
            workoutSection.classList.remove("active");
            activeWorkoutSection.classList.add("active");
          }
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
          if (!exercisesList) return;
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
          if (!exerciseEntry) return;
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
            if (label) {
              label.textContent = `Exercício ${index + 1}`;
            }
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
          const addExerciseButton = document.getElementById("addExercise");
          if (addExerciseButton) {
            addExerciseButton.addEventListener("click", addExerciseField);
          }

          // Event listener para remover exercício
          const exercisesList = document.getElementById("exercisesList");
          if (exercisesList) {
            exercisesList.addEventListener("click", function (e) {
              if (e.target.closest(".remove-exercise")) {
                removeExerciseField(e.target.closest(".remove-exercise"));
              }
            });
          }

          // Event listener para salvar template
          const saveTemplateButton = document.getElementById("saveTemplate");
          if (saveTemplateButton) {
            saveTemplateButton.addEventListener("click", saveNewTemplate);
          }

          // Event listener para resetar o modal quando for fechado
          const createTemplateModal = document.getElementById("createTemplateModal");
          if (createTemplateModal) {
            createTemplateModal.addEventListener("hidden.bs.modal", function () {
              const form = document.getElementById("templateForm");
              if (form) {
                form.reset();
              }

              const exercisesList = document.getElementById("exercisesList");
              if (exercisesList) {
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
              }
            });
          }
        });

        const finishWorkoutButton = document.getElementById("finish-workout");
        if (finishWorkoutButton) {
          finishWorkoutButton.addEventListener("click", () => {
            alert("Workout completed! Data saved.");
            const activeWorkoutSection = document.getElementById("active-workout");
            const workoutSection = document.getElementById("workout");
            if (activeWorkoutSection && workoutSection) {
              activeWorkoutSection.classList.remove("active");
              workoutSection.classList.add("active");
            }
          });
        }

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
          if (logo) {
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
              const homeSection = document.getElementById("home");
              const homeNavLink = document.querySelector('[data-bs-target="home"]');
              if (homeSection && homeNavLink) {
                homeSection.classList.add("active");
                homeNavLink.classList.add("active");
              }

              // Scroll to top
              window.scrollTo(0, 0);
            });
          }
        }

        // Login form handler
        const loginForm = document.getElementById("loginForm");
        if (loginForm) {
          loginForm.addEventListener("submit", async function (e) {
            e.preventDefault();

            const loginButton = document.querySelector("#loginButton");
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
                showNotification("Login successful!");
                window.location.reload();
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
              } else {
                showNotification(data.error, true);
              }
            } catch (error) {
              showNotification("Erro ao conectar com o servidor", true);
            }
          });
        }

        // Update profile form submission
        const profileForm = document.getElementById("profile-form");
        if (profileForm) {
          profileForm.addEventListener("submit", async function (e) {
            e.preventDefault();

            const profileData = {
              age

        // Function to show notifications
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
      });
    </script>
  </body>
</html>
