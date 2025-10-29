// Mobile Navigation Toggle
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');

if (hamburger) {
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
}

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        navLinks.classList.remove('active');
    });
});

// Form Submission
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for your message! I will get back to you soon.');
        this.reset();
    });
}

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if(targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if(targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});

// Add shadow to header on scroll
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    if (header) {
        if (window.scrollY > 100) {
            header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        }
    }
});

// Scroll progress bar
window.addEventListener('scroll', function() {
    const progressBar = document.getElementById('progressBar');
    if (progressBar) {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        progressBar.style.width = scrolled + '%';
    }
});

// Theme toggle functionality
const themeToggle = document.getElementById('themeToggle');
if (themeToggle) {
    themeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-theme');
        const icon = this.querySelector('i');
        if (document.body.classList.contains('dark-theme')) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
            localStorage.setItem('theme', 'dark');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
            localStorage.setItem('theme', 'light');
        }
    });
}

// Check for saved theme preference
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-theme');
    const themeToggleIcon = document.querySelector('.theme-toggle i');
    if (themeToggleIcon) {
        themeToggleIcon.classList.remove('fa-moon');
        themeToggleIcon.classList.add('fa-sun');
    }
}

// Scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            
            // Animate skill bars when skills section is visible
            if (entry.target.classList.contains('skill-progress')) {
                const width = entry.target.getAttribute('data-width');
                entry.target.style.width = width + '%';
            }
            
            // Animate counters when about section is visible
            if (entry.target.classList.contains('counter')) {
                animateCounter(entry.target);
            }
        }
    });
}, observerOptions);

// Observe elements for animation
document.querySelectorAll('.about-text, .about-image, .skill-card, .project-card, .contact-item, .contact-form, .skill-progress, .counter').forEach(el => {
    observer.observe(el);
});

// Active navigation link on scroll
window.addEventListener('scroll', function() {
    let current = '';
    const sections = document.querySelectorAll('section');
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= (sectionTop - 100)) {
            current = section.getAttribute('id');
        }
    });
    
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

// Typing effect
const typingText = document.getElementById('typingText');
if (typingText) {
    const texts = ["Full Stack Developer", "Web Designer", "PHP Developer", "Problem Solver"];
    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    function type() {
        const currentText = texts[textIndex];
        
        if (isDeleting) {
            typingText.textContent = currentText.substring(0, charIndex - 1);
            charIndex--;
        } else {
            typingText.textContent = currentText.substring(0, charIndex + 1);
            charIndex++;
        }
        
        if (!isDeleting && charIndex === currentText.length) {
            isDeleting = true;
            setTimeout(type, 2000);
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            textIndex = (textIndex + 1) % texts.length;
            setTimeout(type, 500);
        } else {
            setTimeout(type, isDeleting ? 100 : 150);
        }
    }

    // Start typing effect
    setTimeout(type, 1000);
}

// Animate counters
function animateCounter(counter) {
    const target = parseInt(counter.getAttribute('data-target'));
    const increment = target / 100;
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            counter.textContent = target;
            clearInterval(timer);
        } else {
            counter.textContent = Math.floor(current);
        }
    }, 20);
}

// Dynamic projects loading
const projects = [
    {
        id: 1,
        title: "Shukla Advocate",
        description: "A responsive dashboard built with PHP for managing legal cases, client information, and appointments for a law firm.",
        technologies: ["HTML", "CSS", "JavaScript", "PHP"],
        liveLink: "https://shuklaadvocates.com",
        codeLink: "#",
        color: "linear-gradient(135deg, #667eea 0%, #764ba2 100%)",
        icon: "fas fa-gavel",
        details: "This project involved creating a comprehensive dashboard for a law firm to manage their cases, clients, and appointments. The system includes user authentication, case tracking, client management, and appointment scheduling features."
    },
    {
        id: 2,
        title: "E-Commerce Platform",
        description: "A full-featured online store with product catalog, shopping cart, user authentication, and payment integration.",
        technologies: ["HTML", "CSS", "JavaScript", "PHP", "SQL"],
        liveLink: "#",
        codeLink: "#",
        color: "linear-gradient(135deg, #f093fb 0%, #f5576c 100%)",
        icon: "fas fa-shopping-cart",
        details: "Developed a complete e-commerce solution with product management, shopping cart functionality, user registration and authentication, order processing, and payment gateway integration."
    },
    {
        id: 3,
        title: "Task Management App",
        description: "A productivity application for creating, organizing, and tracking tasks with team collaboration features.",
        technologies: ["HTML", "CSS", "JavaScript", "PHP", "SQL"],
        liveLink: "#",
        codeLink: "#",
        color: "linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)",
        icon: "fas fa-tasks",
        details: "Built a task management application that allows users to create projects, assign tasks, set deadlines, and track progress. Includes features for team collaboration and progress visualization."
    }
];

function loadProjects() {
    const projectsContainer = document.getElementById('projectsContainer');
    if (projectsContainer) {
        projectsContainer.innerHTML = '';
        
        projects.forEach(project => {
            const projectCard = document.createElement('div');
            projectCard.className = 'project-card';
            projectCard.innerHTML = `
                <div class="project-img" style="background: ${project.color};">
                    <i class="${project.icon}"></i>
                </div>
                <div class="project-content">
                    <h3>${project.title}</h3>
                    <p>${project.description}</p>
                    <div class="project-tech">
                        ${project.technologies.map(tech => `<span class="tech-tag">${tech}</span>`).join('')}
                    </div>
                    <div class="project-links">
                        <a href="${project.liveLink}" target="_blank" class="btn">Live Demo</a>
                        <a href="${project.codeLink}" class="btn btn-outline">Code</a>
                        <button class="btn btn-outline view-details" data-id="${project.id}">Details</button>
                    </div>
                </div>
            `;
            projectsContainer.appendChild(projectCard);
            
            // Add observer for animation
            observer.observe(projectCard);
        });
        
        // Add event listeners for detail buttons
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const projectId = parseInt(this.getAttribute('data-id'));
                openProjectModal(projectId);
            });
        });
    }
}

// Modal functionality
const modal = document.getElementById('projectModal');
const closeModal = document.getElementById('closeModal');

function openProjectModal(projectId) {
    const project = projects.find(p => p.id === projectId);
    if (project && modal) {
        document.getElementById('modalTitle').textContent = project.title;
        document.getElementById('modalContent').innerHTML = `
            <p><strong>Description:</strong> ${project.description}</p>
            <p><strong>Technologies:</strong> ${project.technologies.join(', ')}</p>
            <p><strong>Details:</strong> ${project.details}</p>
            <div class="project-links" style="margin-top: 20px;">
                <a href="${project.liveLink}" target="_blank" class="btn">Live Demo</a>
                <a href="${project.codeLink}" class="btn btn-outline">View Code</a>
            </div>
        `;
        modal.style.display = 'flex';
    }
}

if (closeModal) {
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });
}

if (modal) {
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Set current year in footer
const currentYear = document.getElementById('currentYear');
if (currentYear) {
    currentYear.textContent = new Date().getFullYear();
}

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    loadProjects();
});