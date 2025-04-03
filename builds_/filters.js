const filterItems = (items, searchTerm) => {
    if (!items || typeof items !== 'object') return {};
    
    const normalizedSearch = searchTerm.toLowerCase()
        .replace(/\s+/g, '')
        .replace('pénétration', 'penetration');

    return Object.fromEntries(
        Object.entries(items).filter(([_, item]) => {
            // Vérifier dans toute la description et le nom
            const itemBasicInfo = (item.description + item.name || "").toLowerCase();
            const hasMatchingText = itemBasicInfo.includes(normalizedSearch);
            
            // Vérifier dans les stats (objet)
            const hasMatchingStats = item.stats && 
                Object.keys(item.stats).some(statName => 
                    statName.toLowerCase().includes(normalizedSearch)
                );
            
            // Vérifier dans les tags (tableau)
            const hasMatchingTags = item.tags && 
                Array.isArray(item.tags) &&
                item.tags.some(tag => 
                    normalizedSearch.includes(tag.toLowerCase()) || 
                    tag.toLowerCase().includes(normalizedSearch)
                );

            return hasMatchingText || hasMatchingStats || hasMatchingTags;
        })
    );
};

export { filterItems };
