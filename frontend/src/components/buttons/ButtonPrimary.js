import { Button } from 'react-bootstrap';
import './buttonStyles.css';

const ButtonPrimary = ({ variant = 'custom', buttonText, type, className = '', ...props}) => {
    return (
        <div className={'button-container'}>
            <Button
                variant={variant}
                type={type}
                className={`custom-button ${className}`}
                {...props}
            >
                {buttonText}
            </Button>
        </div>
    );
};

export default ButtonPrimary;