// main.js
document.addEventListener('DOMContentLoaded', function() {
    // Navigation
    const navLinks = document.querySelectorAll('.nav-link, .card .btn');
    const contentSections = document.querySelectorAll('.content-section');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-bs-target');
            
            contentSections.forEach(section => {
                section.classList.remove('active');
            });

            document.getElementById(targetId).classList.add('active');

            navLinks.forEach(navLink => {
                navLink.classList.remove('active');
            });

            if (this.classList.contains('nav-link')) {
                this.classList.add('active');
            }

            // Scroll to top when changing sections
            window.scrollTo(0, 0);
        });
    });

    // Workout template data
    const workoutTemplates = {
        'Leg Day': ['Squats', 'Leg Press', 'Lunges', 'Calf Raises'],
        'Push Day': ['Bench Press', 'Shoulder Press', 'Tricep Extensions', 'Push-ups'],
        'Pull Day': ['Pull-ups', 'Rows', 'Bicep Curls', 'Deadlifts'],
        'Cardio': ['Running', 'Cycling', 'Swimming']
    };

    function initWorkout() {
        const workoutSection = document.getElementById('workout-templates');
        workoutSection.innerHTML = '';

        for (const [template, exercises] of Object.entries(workoutTemplates)) {
            const templateCard = document.createElement('div');
            templateCard.className = 'col-md-4 mb-3';
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
        document.querySelectorAll('.workout-template').forEach(template => {
            template.addEventListener('click', startWorkout);
        });

        // Add event listener to create new template button
        document.getElementById('create-template').addEventListener('click', createTemplate);
    }

    function startWorkout(event) {
        const template = event.currentTarget.dataset.template;
        const exercises = workoutTemplates[template];
        const workoutExercises = document.getElementById('workout-exercises');
        workoutExercises.innerHTML = '';

        exercises.forEach(exercise => {
            const exerciseItem = document.createElement('div');
            exerciseItem.className = 'exercise-item';
            if (template === 'Cardio') {
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

        document.getElementById('workout').classList.remove('active');
        document.getElementById('active-workout').classList.add('active');
    }

    function createTemplate() {
        const templateName = prompt("Enter a name for the new workout template:");
        if (templateName) {
            workoutTemplates[templateName] = [];
            let exercise;
            do {
                exercise = prompt("Enter an exercise name (or click Cancel to finish):");
                if (exercise) {
                    workoutTemplates[templateName].push(exercise);
                }
            } while (exercise);
            initWorkout();
        }
    }

    document.getElementById('finish-workout').addEventListener('click', () => {
        alert("Workout completed! Data saved.");
        document.getElementById('active-workout').classList.remove('active');
        document.getElementById('workout').classList.add('active');
    });

    function initProfile() {
        const profileSection = document.getElementById('profile');
        profileSection.innerHTML = `
            <h2 class="mb-4">Your Profile</h2>
            <p>Profile management functionality coming soon!</p>
        `;
    }

    function initStats() {
        const statsSection = document.getElementById('stats');
        statsSection.innerHTML = `
            <h2 class="mb-4">Your Statistics</h2>
            <p>Statistics tracking functionality coming soon!</p>
        `;
    }

    // Initialize content
    initWorkout();
    initProfile();
    initStats();
});