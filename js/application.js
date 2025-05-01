document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterForm = document.querySelector('.filter-container');
    const filterButton = document.querySelector('.filter-button');
    
    filterButton.addEventListener('click', function() {
        // Get filter values
        const typeFilter = document.getElementById('filter-type').value;
        const statusFilter = document.getElementById('filter-status').value;
        const sortFilter = document.getElementById('filter-date').value;
        
        // Build query string
        let queryParams = [];
        
        if (typeFilter) {
            queryParams.push(`type=${encodeURIComponent(typeFilter)}`);
        }
        
        if (statusFilter) {
            queryParams.push(`status=${encodeURIComponent(statusFilter)}`);
        }
        
        if (sortFilter) {
            queryParams.push(`sort=${encodeURIComponent(sortFilter)}`);
        }
        
        // Create URL with query parameters
        const queryString = queryParams.length > 0 ? `?${queryParams.join('&')}` : '';
        window.location.href = `my-applications.php${queryString}`;
    });
    
    // Status badge hover effect
    const statusBadges = document.querySelectorAll('.status-badge');
    statusBadges.forEach(badge => {
        badge.addEventListener('mouseover', function() {
            this.setAttribute('data-original-text', this.textContent);
            
            const status = this.textContent.toLowerCase();
            
            // Show different message based on status
            if (status === 'pending') {
                this.textContent = 'Under Review';
            } else if (status === 'approved') {
                this.textContent = 'Congratulations!';
            } else if (status === 'rejected') {
                this.textContent = 'Try Another Pet';
            }
        });
        
        badge.addEventListener('mouseout', function() {
            this.textContent = this.getAttribute('data-original-text');
        });
    });
});