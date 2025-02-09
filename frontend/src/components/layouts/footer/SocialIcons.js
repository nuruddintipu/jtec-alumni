import {FontAwesomeIcon} from '@fortawesome/react-fontawesome';
import {faFacebook, faInstagram, faLinkedin, faTwitter} from "@fortawesome/free-brands-svg-icons";
import {useState} from "react";
import {Col} from "react-bootstrap";


function SocialIcon({icon, size = "1x", style = {}, className = "", href = ""}) {
    const [hover, setHover] = useState(false);

    const iconStyle = {
        cursor: 'pointer',
        transition: 'transform 0.3s ease',
        color: '#fff',
        transform: hover ? 'scale(1.2)' : 'scale(1)',
        ...style,
    };

    return (
        <a href={href}
           onMouseEnter={() => setHover(true)}
           onMouseLeave={() => setHover(false)}
           target="_blank"
           rel="noopener noreferrer"
           className={className}
           style={{...style}}>

            <FontAwesomeIcon
                style={iconStyle}
                icon={icon}
                size={size}
            />
        </a>
    );
}




function SocialIcons() {

    const styles = {
        display: 'flex',
        gap: '10px',
        justifyContent: 'center',
    };


    return (
        <Col md={6} className="text-center text-md-end">
            <h3 className="h4 mb-3">Follow Us</h3>
            <div className="d-flex justify-content-center justify-content-md-end">
                <div style={styles}>
                    <SocialIcon icon={faTwitter}/>
                    <SocialIcon href="https://www.facebook.com/sktecalumni"
                                icon={faFacebook}/>
                    <SocialIcon icon={faInstagram}/>
                    <SocialIcon icon={faLinkedin}/>
                </div>
            </div>
        </Col>

    );
}

export default SocialIcons;
