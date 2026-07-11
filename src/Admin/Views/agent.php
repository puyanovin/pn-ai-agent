<?php

if (!defined('ABSPATH')) {
    exit;
}

$tab = $_GET['tab'] ?? 'general';
?>

<div class="wrap">

<h1>PN AI Agent</h1>

<h2 class="nav-tab-wrapper">

<a href="?page=pn-ai-agent&tab=general"
class="nav-tab <?php echo $tab==='general'?'nav-tab-active':''; ?>">
General
</a>

<a href="?page=pn-ai-agent&tab=providers"
class="nav-tab <?php echo $tab==='providers'?'nav-tab-active':''; ?>">
Providers
</a>

<a href="?page=pn-ai-agent&tab=models"
class="nav-tab <?php echo $tab==='models'?'nav-tab-active':''; ?>">
Models
</a>

<a href="?page=pn-ai-agent&tab=agents"
class="nav-tab <?php echo $tab==='agents'?'nav-tab-active':''; ?>">
Agents
</a>

<a href="?page=pn-ai-agent&tab=mcp"
class="nav-tab <?php echo $tab==='mcp'?'nav-tab-active':''; ?>">
MCP
</a>

<a href="?page=pn-ai-agent&tab=knowledge"
class="nav-tab <?php echo $tab==='knowledge'?'nav-tab-active':''; ?>">
Knowledge
</a>

<a href="?page=pn-ai-agent&tab=chatbot"
class="nav-tab <?php echo $tab==='chatbot'?'nav-tab-active':''; ?>">
Chatbot
</a>

<a href="?page=pn-ai-agent&tab=images"
class="nav-tab <?php echo $tab==='images'?'nav-tab-active':''; ?>">
Images
</a>

<a href="?page=pn-ai-agent&tab=users"
class="nav-tab <?php echo $tab==='users'?'nav-tab-active':''; ?>">
Users
</a>

<a href="?page=pn-ai-agent&tab=history"
class="nav-tab <?php echo $tab==='history'?'nav-tab-active':''; ?>">
Logs
</a>

<a href="?page=pn-ai-agent&tab=license"
class="nav-tab <?php echo $tab==='license'?'nav-tab-active':''; ?>">
License
</a>

</h2>

<?php

switch ($tab) {

    case 'general':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/general.php';
        break;

    case 'providers':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/providers.php';
        break;

    case 'models':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/models.php';
        break;

    case 'agents':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/agents.php';
        break;

    case 'mcp':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/mcp.php';
        break;

    case 'knowledge':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/knowledge.php';
        break;

    case 'chatbot':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/chat.php';
        break;

    case 'images':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/images.php';
        break;

    case 'users':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/users.php';
        break;

    case 'logs':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/logs.php';
        break;
        
    case 'history':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/history.php';
        break;

    case 'license':
        require PN_AI_AGENT_PATH . 'src/Admin/Views/license.php';
        break;

    default:
        require PN_AI_AGENT_PATH . 'src/Admin/Views/general.php';
        break;
}
?>

</div>