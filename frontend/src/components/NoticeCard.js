import { Card } from "react-bootstrap";
import { Link } from "react-router-dom";

const MAX_TEXT_LENGTH = 200;

const NoticeCard = ({ noticeData, ...rest }) => {
    const { id, title, subtitle, text } = noticeData;

    const truncatedText =
        text.length > MAX_TEXT_LENGTH ? `${text.slice(0, MAX_TEXT_LENGTH)}...` : text;

    return (
        <Card style={{ width: "80%" }} className="mb-4 shadow-sm" {...rest}>
            <Card.Body>
                <Card.Title className="fw-bold">{title}</Card.Title>
                {subtitle && <Card.Subtitle className="text-muted mb-2">{subtitle}</Card.Subtitle>}
                <Card.Text>
                    {truncatedText}
                    {text.length > MAX_TEXT_LENGTH && (
                        <>
                            {" "}
                            <Link to={`/notice/${id}`} className="text-primary">
                                See More
                            </Link>
                        </>
                    )}
                </Card.Text>
            </Card.Body>
        </Card>
    );
};

export default NoticeCard;
