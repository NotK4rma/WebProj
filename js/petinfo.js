

document.addEventListener('DOMContentLoaded', function() {
   
    const modal = document.getElementById('applicationFormModal');
    const openBtn = document.getElementById('openApplicationFormBtn');
    const closeBtn = document.querySelector('.close-modal');
    const cancelBtn = document.getElementById('cancelApplicationBtn');

    if (openBtn) {
        openBtn.addEventListener('click', () => {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden'; 
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
            document.body.style.overflow = ''; 
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            modal.style.display = 'none';
            document.body.style.overflow = ''; 
        });
    }

    
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = ''; 
        }
    });
    
  
    const adoptionForm = document.querySelector('.adoption-form');
    if (adoptionForm) {
        adoptionForm.addEventListener('submit', function(event) {
            const notesField = document.getElementById('application_notes');
            if (notesField && notesField.value.trim() === '') {
                event.preventDefault();
                alert('Please tell us why you\'d like to adopt this pet before submitting.');
                notesField.focus();
            }
        });
    }
    
  
    const successMessage = document.querySelector('.success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = '0';
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 1000);
        }, 5000);
    }
    
   
    const applyBtn = document.querySelector('.apply-btn:not(.disabled)');
    if (applyBtn) {
        applyBtn.addEventListener('click', function() {
          
            if (this.id !== 'openApplicationFormBtn') {
                const adoptionSection = document.querySelector('.adoption-section');
                if (adoptionSection) {
                    adoptionSection.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    }
});