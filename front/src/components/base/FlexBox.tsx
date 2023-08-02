import classNames from 'classnames';

export default function FlexBox({ className, children, ...rest }){
    const finalClasses = classNames('flex', className)

    return(
        <div className={finalClasses} {...rest}>
            {children}
        </div>
    );
}