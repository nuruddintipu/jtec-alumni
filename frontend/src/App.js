import './styles/App.css';
import AppRoutes from './routes/AppRoutes';
import { BrowserRouter as Router } from 'react-router-dom';

function App() {
    return (
        <Router>
            <div className="app-container">
                <AppRoutes/>
            </div>
        </Router>
    );
}

export default App;
