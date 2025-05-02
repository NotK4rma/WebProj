
document.addEventListener('DOMContentLoaded', function() {
    
    const filterType = document.getElementById('filter-type');
    const filterAge = document.getElementById('filter-age');
    const filterGender = document.getElementById('filter-gender');
    const filterButton = document.querySelector('.filter-button');
    
    
    filterButton.addEventListener('click', applyFilters);
    
    
    function applyFilters() {
        
        const currentUrl = new URL(window.location.href);
        const searchParams = currentUrl.searchParams;
        
        
        if (filterType.value) {
            searchParams.set('type', filterType.value);
        } else {
            searchParams.delete('type');
        }
        
        if (filterAge.value) {
            searchParams.set('age', filterAge.value);
        } else {
            searchParams.delete('age');
        }
        
        if (filterGender.value) {
            searchParams.set('gender', filterGender.value);
        } else {
            searchParams.delete('gender');
        }
        
        
        window.location.href = currentUrl.toString();
    }
    
    
    [filterType, filterAge, filterGender].forEach(filter => {
        filter.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });
    });
    
    
    const petCards = document.querySelectorAll('.pet-card');
    
    petCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const nameElement = this.querySelector('.pet-name');
            nameElement.classList.add('name-highlight');
        });
        
        card.addEventListener('mouseleave', function() {
            const nameElement = this.querySelector('.pet-name');
            nameElement.classList.remove('name-highlight');
        });
    });
});