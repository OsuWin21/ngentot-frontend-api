// Player Status Module
const PlayerStatus = (() => {
    // Configuration
    const config = {
        updateInterval: 10000, // 10 seconds
        apiEndpoint: 'https://api.osuwin21.my.id/v1/get_player_status'
    };

    // Get user ID from URL
    const getUserId = () => {
        const match = window.location.pathname.match(/\/u\/(\d+)/);
        return match ? match[1] : '4'; // Default to 4 if not found
    };

    // Constants
    const MODE_NAMES = {
        0: "osu!", 1: "osu! Taiko", 2: "osu! Catch", 3: "osu! Mania",
        4: "osu! Relax", 5: "osu! Relax Taiko", 6: "osu! Relax Catch", 8: "osu! AutoPilot"
    };

    const ACTION_LABELS = {
        0: "Idle", 1: "AFK", 2: "Playing", 3: "Editing", 4: "Modding",
        5: "Multiplayer", 6: "Watching", 7: "Unknown", 8: "Testing",
        9: "Submitting", 10: "Paused", 11: "Lobby", 12: "Multiplaying", 13: "osu!Direct"
    };

    const MOD_SHORTNAMES = {
        1: 'NF', 2: 'EZ', 4: 'TD', 8: 'HD', 16: 'HR', 32: 'SD', 64: 'DT',
        128: 'RX', 256: 'HT', 1024: 'FL', 2048: 'AT', 4096: 'SO', 8192: 'AP',
        512: 'NC', 16384: 'PF'
    };

    // DOM Elements
    const elements = {
        icon: document.getElementById('status-icon'),
        text: document.getElementById('status-text')
    };

    // Format time
    const formatTime = (timestamp) => {
        if (!timestamp) return 'Unknown';
        const diff = (Date.now()/1000 - timestamp);
        return diff < 60 ? 'Just now' :
               diff < 3600 ? `${Math.floor(diff/60)}m ago` :
               diff < 86400 ? `${Math.floor(diff/3600)}h ago` :
               new Date(timestamp * 1000).toLocaleDateString();
    };

    // Decode mods
    const decodeMods = (mods, action) => {
        if (![2, 5, 12].includes(action)) return [];
        mods = parseInt(mods) || 0;
        const activeMods = [];
        
        // Handle special combined mods
        if (mods & 512) activeMods.push('NC');
        else if (mods & 64) activeMods.push('DT');
        if (mods & 16384) activeMods.push('PF');
        
        // Add other mods (excluding RX and AP)
        for (const [bit, name] of Object.entries(MOD_SHORTNAMES)) {
            if (mods & bit && ![128, 8192].includes(+bit)) activeMods.push(name);
        }
        
        return activeMods;
    };

    // Update display
    const updateUI = (data) => {
        if (!elements.icon || !elements.text) return;
        
        // Clear and create icon
        elements.icon.innerHTML = '<i class="mdi mdi-circle-medium"></i>';
        const icon = elements.icon.firstChild;
        
        let statusText, colorClass;
        
        if (data.error) {
            colorClass = 'text-danger';
            statusText = 'Status unavailable';
        } else if (!data.online) {
            colorClass = 'text-secondary';
            statusText = `Offline (last seen - ${formatTime(data.last_seen)})`;
        } else {
            const { action, info_text, mode, mods } = data.status || {};
            const actionText = ACTION_LABELS[action] || 'Unknown';
            const modeText = MODE_NAMES[mode] || 'osu!';
            const modText = decodeMods(mods, action).join('');
            
            // Set color based on activity
            colorClass = [2, 5, 12].includes(action) ? 'text-success' :
                        [0, 1, 10].includes(action) ? 'text-warning' :
                        action === 13 ? 'text-primary' : 'text-info';
            
            statusText = action === 13 ? 'Browsing osu!Direct' : 
                `${actionText} ${info_text || ''} ${modText ? `+${modText}` : ''} in ${modeText}`.trim();
        }
        
        icon.className = `mdi mdi-circle-medium ${colorClass}`;
        icon.style.cssText = 'font-size:1.2rem;line-height:1;vertical-align:middle';
        elements.text.textContent = statusText;
    };

    // Fetch status
    const getStatus = async () => {
        try {
            const res = await fetch(`${config.apiEndpoint}?id=${getUserId()}`);
            if (!res.ok) throw new Error('Request failed');
            
            const { status, player_status } = await res.json();
            if (status !== 'success') throw new Error('API error');
            
            return { 
                online: player_status?.online,
                last_seen: player_status?.last_seen,
                status: player_status?.status,
                error: false
            };
        } catch (err) {
            console.error('Status error:', err);
            return { error: true };
        }
    };

    // Initialize
    const init = () => {
        const update = () => getStatus().then(updateUI);
        update();
        setInterval(update, config.updateInterval);
    };

    return { init };
})();

// Start when ready
document.addEventListener('DOMContentLoaded', PlayerStatus.init);